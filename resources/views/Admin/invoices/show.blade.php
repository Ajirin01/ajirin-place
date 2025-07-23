@extends('layouts.admin_base2')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Invoice: {{ $invoice->invoice_code }}</h4>
            <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm btn-warning">Edit</a>
        </div>
        <div class="card-body">
            <p><strong>Customer:</strong> {{ $invoice->customer_name ?? 'Guest' }}</p>
            <p><strong>Status:</strong> 
                <span class="badge {{ $invoice->status === 'paid' ? 'badge-success' : ($invoice->status === 'pending' ? 'badge-warning' : 'badge-secondary') }}">
                    {{ ucfirst($invoice->status) }}
                </span>
            </p>
            <p><strong>Date:</strong> {{ $invoice->created_at->format('M d, Y') }}</p>

            <hr>

            <h5>Items</h5>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->items as $item)
                    <tr>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₦{{ number_format($item->unit_price, 2) }}</td>
                        <td>₦{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right">
                <h5>Total: ₦{{ number_format($invoice->total, 2) }}</h5>
            </div>
        </div>
    </div>
</div>
@endsection
