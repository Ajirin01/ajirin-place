@extends('layouts.admin_base2')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Preorder</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.preorders.index') }}">Preorders</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card card-warning">
      <div class="card-header"><h3 class="card-title">Edit Preorder</h3></div>

      <form action="{{ route('admin.preorders.update', $preorder->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
          <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $preorder->name }}" required>
          </div>

          <div class="form-group">
            <label for="product_details">Product Details</label>
            <textarea name="product_details" id="product_details" class="form-control" rows="4" required>{{ $preorder->product_details }}</textarea>
          </div>

          <div class="form-group">
            <label for="amount">Expected Amount</label>
            <input type="number" step="0.01" name="estimated_cost" class="form-control" id="amount" value="{{ $preorder->amount }}" required>
          </div>

          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
              <option value="pending" {{ $preorder->status == 'pending' ? 'selected' : '' }}>Pending</option>
              <option value="paid" {{ $preorder->status == 'paid' ? 'selected' : '' }}>Paid</option>
              <option value="processing" {{ $preorder->status == 'processing' ? 'selected' : '' }}>Processing</option>
              <option value="shipped" {{ $preorder->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
              <option value="completed" {{ $preorder->status == 'completed' ? 'selected' : '' }}>Completed</option>
              <option value="canceled" {{ $preorder->status == 'canceled' ? 'selected' : '' }}>canceled</option>
            </select>
          </div>
        </div>

        <div class="card-footer text-right">
          <button type="submit" class="btn btn-primary">Update Preorder</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
