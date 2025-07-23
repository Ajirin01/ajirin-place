<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use App\Order;
use App\Cart;
use App\ShippingAddress;

use	Illuminate\Support\Facades\Mail; 


use App\Mail\OrderConfirmation;
use App\Mail\NewOrderAlert;

class PaymentController extends Controller
{
    public function initialize()
    {
        $cartItems = session('cart_items');
        $meta      = session('payment_meta');

        $txRef = 'AJR_' . uniqid();
        Session::put('tx_ref', $txRef);

        $client = new Client();

        $response = $client->post('https://api.flutterwave.com/v3/payments', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('FLWSECK_TEST'),
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'tx_ref'         => $txRef,
                'amount'         => $meta['total'],
                'currency'       => 'NGN',
                'redirect_url'   => route('payment.callback'),
                'payment_options'=> 'card',
                'customer' => [
                    'email' => auth()->user()->email,
                    'name'  => auth()->user()->name,
                ],
                'meta' => $meta,
                'customizations' => [
                    'title' => 'Ajirin Place',
                    'description' => 'Order Payment',
                ],
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return redirect($data['data']['link']);
    }

    public function callback(Request $request)
    {
        /* 1. Quick sanity check from Flutterwave redirect */
        if ($request->status !== 'successful') {
            return view('payment.failed');
        }

        /* 2. Verify the transaction on Flutterwave */
        $client   = new Client();
        $txId     = $request->transaction_id;
        $response = $client->get(
            "https://api.flutterwave.com/v3/transactions/{$txId}/verify",
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('FLWSECK_TEST'),  // use your env key
                    'Accept'        => 'application/json',
                ],
            ]
        );

        $verify = json_decode($response->getBody()->getContents(), true);

        /* 3. Double‑check status and our tx_ref token */
        if (
            $verify['status'] !== 'success' ||
            $verify['data']['tx_ref'] !== Session::pull('tx_ref')
        ) {
            return view('payment.failed');
        }

        /* 4. Retrieve metadata we sent in the initialise step */
        $meta = $verify['data']['meta'];           // ['shipping_id' => …, 'total' => …, …]

        // return response()->json($meta['shipping_id']);

        /* 5. Rebuild & save the final order */

        $data = [
            'shipping_details' => ShippingAddress::find($meta['shipping_id']),
            'order_number'     => rand(123456789, 999999999),
            'user_email'       => $verify['data']['customer']['email'],
            'cart'             => session('cart_items'),
            'order_total'      => $meta['total'] ?? 0,
            'payment_method'   => 'flutterwave',
            'status'           => 'paid',
            'sale_mode'        => $meta['sale_mode'] ?? 'retail', // 👈 safe fallback
        ];

        $order = Order::create($data);


        /* 6. Clear cart & session scratch data */
        Cart::where('user_id', $meta['user_id'])->delete();
        Session::forget(['cart_items', 'payment_meta']);

        // return response()->json($order);

        // ✅ Send confirmation to user
        Mail::to($data['shipping_details']->email)->send(new OrderConfirmation($data));

        // ✅ Alert store admin (change to your store email)
        Mail::to('mubarakolagoke@gmail.com')->send(new NewOrderAlert($data));

        /* 7. Redirect to confirmation */
        return redirect()->route('order.confirmation', $order->order_number);
    }

}

