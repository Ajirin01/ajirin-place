<h2>Order Confirmation</h2>
<p>Hello {{ $order['shipping_details']['first_name'] . ' ' . $order['shipping_details']['last_name'] }},</p>

<p>Thank you for your order at <strong>Ajirin Place</strong>.</p>

<p><strong>Order Summary:</strong></p>
<ul>
    @foreach (json_decode($order['cart']) as $item)
        <li>
            Product: {{ $item->product_name ?? 'Unknown' }}<br>
            Quantity: {{ $item->product_quantity }}<br>
            Unit Price: ₦{{ number_format($item->product_price, 2) }}<br>
            Subtotal: ₦{{ number_format($item->subtotal, 2) }}
        </li>
        <hr>
    @endforeach
    <li><strong>Total:</strong> ₦{{ number_format($order['order_total'], 2) }}</li>
    <li><strong>Order Code:</strong> {{ $order['order_number'] }}</li>
</ul>

<p>Your order is being processed. You’ll receive another email once it's ready for delivery.</p>

<p>Thanks again!<br>Ajirin Place</p>
