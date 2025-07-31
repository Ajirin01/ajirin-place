<h2>New Order Notification</h2>

<p>A new order has just been placed on <strong>Ajirin Place</strong>:</p>

<ul>
    <li><strong>Name:</strong> {{ $order['shipping_details']['first_name'] . ' ' . $order['shipping_details']['last_name'] }}</li>
    <li><strong>Email:</strong> {{ $order['shipping_details']['email'] }}</li>
    <li><strong>Phone:</strong> {{ $order['shipping_details']['phone'] }}</li>
    <li><strong>Total:</strong> ₦{{ number_format($order['order_total'], 2) }}</li>
    <li><strong>Order Code:</strong> {{ $order['order_number'] }}</li>
</ul>

<p><strong>Order Details:</strong></p>

@php
    $cartItems = json_decode($order['cart'], true);
@endphp

<ul>
    @foreach ($cartItems as $item)
        @php
            $product = \App\Product::find($item['product_id']);
        @endphp
        <li>
            <strong>Product:</strong> {{ $product->name ?? 'Unknown Product' }}<br>
            <strong>Quantity:</strong> {{ $item['product_quantity'] }}<br>
            <strong>Unit Price:</strong> ₦{{ number_format($item['product_price'], 2) }}<br>
            <strong>Subtotal:</strong> ₦{{ number_format($item['subtotal'], 2) }}
        </li>
        <hr>
    @endforeach
</ul>

<p>Please log in to the <a href="{{ url('/admin/order/pending') }}">admin dashboard</a> to process this order.</p>
