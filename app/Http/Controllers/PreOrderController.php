<?php

namespace App\Http\Controllers;

use App\PreOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class PreOrderController extends Controller
{
    public function create()
    {
        return view('preorder.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'product_details' => 'required',
        ]);

        $data['invoice_code'] = strtoupper(Str::random(8));

        $preOrder = PreOrder::create($data);

        // Send email to user
        Mail::to($preOrder->email)->send(new \App\Mail\PreOrderConfirmation($preOrder));

        // Send email to shop
        Mail::to(config('mail.from.address'))->send(new \App\Mail\NewPreOrderAlert($preOrder));

        return redirect()->route('preorder.thankyou', ['code' => $preOrder->invoice_code]);
    }

    public function thankYou($code)
    {
        $order = PreOrder::where('invoice_code', $code)->firstOrFail();
        return view('preorder.thankyou', compact('order'));
    }

    public function invoice($code)
    {
        $order = PreOrder::where('invoice_code', $code)->firstOrFail();
        return view('preorder.invoice', compact('order'));
    }
}

