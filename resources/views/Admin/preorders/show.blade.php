@extends('layouts.admin_base2')

@section('content')
<section class="content-header">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <h1>Preorder Details</h1>
    <a href="{{ route('admin.preorders.index') }}" class="btn btn-secondary mt-2">← Back to List</a>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Invoice Code: {{ $order->invoice_code }}</h3>
        <a href="{{ route('admin.preorders.edit', $order->id) }}" class="btn btn-sm btn-primary">✏️ Edit</a>
      </div>
      <div class="card-body">
        <p><strong>Customer:</strong> {{ $order->name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Status:</strong>
          <span class="badge 
            @switch($order->status)
              @case('pending') badge-warning @break
              @case('invoiced') badge-primary @break
              @case('processing') badge-info @break
              @case('completed') badge-success @break
              @case('declined') badge-danger @break
              @default badge-secondary
            @endswitch
          ">
            {{ ucfirst($order->status) }}
          </span>
        </p>
        <p><strong>Estimated Cost:</strong> ₦{{ number_format($order->estimated_cost ?? 0, 2) }}</p>
        <p><strong>Created At:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>

        <hr>
        <h5>Product Details</h5>
        @php
          $items = json_decode($order->product_details, true);
        @endphp

        @if (is_array($items))
          <ul>
            @foreach ($items as $item)
              <li>
                <strong>{{ $item['name'] ?? 'Unnamed Item' }}</strong> × {{ $item['quantity'] ?? 1 }}
              </li>
            @endforeach
          </ul>
        @else
          <p>{{ $order->product_details }}</p>
        @endif

      </div>
    </div>
  </div>
</section>
@endsection
