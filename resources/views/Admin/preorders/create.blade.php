@extends('layouts.admin_base2')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Create Preorder</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.preorders.index') }}">Preorders</a></li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header"><h3 class="card-title">Preorder Information</h3></div>

      <form action="{{ route('admin.preorders.store') }}" method="POST">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" required>
          </div>

          <div class="form-group">
            <label for="email">Customer Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
          </div>

          <div class="form-group">
            <label for="phone">Customer Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" required>
          </div>

          <div class="form-group">
            <label for="product_details">Product Details</label>
            <textarea name="product_details" id="product_details" class="form-control" rows="4" required></textarea>
          </div>

          <div class="form-group">
            <label for="amount">Expected Amount</label>
            <input type="number" step="0.01" name="estimated_cost" class="form-control" id="amount" required>
          </div>

          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
              <option value="pending">Pending</option>
              <option value="reviewed">Reviewed</option>
              <option value="completed">Completed</option>
            </select>
          </div>
        </div>

        <div class="card-footer text-right">
          <button type="submit" class="btn btn-success">Save Preorder</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
