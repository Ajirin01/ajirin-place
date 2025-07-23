@extends('layouts.admin_base2')

@section('content')
<div class="container mt-4">
    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h4>Edit Invoice: {{ $invoice->invoice_code }}</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Customer Name</label>
                    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', $invoice->customer_name) }}">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="pending" {{ $invoice->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="cancelled" {{ $invoice->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Total Amount</label>
                    <input type="number" name="total" class="form-control" value="{{ old('total', $invoice->total) }}" step="0.01">
                </div>

                {{-- Optionally allow editing items (not included here for simplicity) --}}

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Update Invoice</button>
                    <a href="{{ route('invoices.show', $invoice->invoice_code) }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
