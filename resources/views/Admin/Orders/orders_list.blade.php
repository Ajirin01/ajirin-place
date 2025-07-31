@extends('layouts.admin_base2')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All {{$type}} Orders </h3>
                {{-- <a style="float: right" href="{{url('orders.create', $)}}"><h3 class="card-title">Add Product</h3></a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    {{-- <th>Wholeorder Stock</th> --}}
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->order_number}}</td>
                        <td>{{$order->order_total}}</td>
                        <td>{{$order->payment_method}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->status}}</td>
                        <td>
                          <form id="update-empty" action="{{ route('update_order_status', $order->id) }}" method="post">
                            @csrf
                            <select name="order_status" id="" class="form-control">
                              <option value="pending">pending</option>
                              <option value="confrimed">confrimed</option>
                              <option value="shipped">shipped</option>
                              <option value="completed">completed</option>
                              <option value="canceled">canceled</option>
                              <option value="pay on delivery">pay on delivery</option>
                            </select>
                            <input type="submit" value="update" class="btn btn-warning form-control">
                          
                          </form>
                            {{-- <a class="btn" href="{{ route('orders.edit', $order->id) }}">
                                <i class="fas fa-edit text-warning"></i> Edit
                            </a> --}}
                            <a class="btn" href="{{ route('order_details', $order->id) }}">
                                <i class="fas fa-eye text-primary"></i> View
                            </a>
                            
                            @can('isAdmin')
                              <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');" style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn">
                                      <i class="fas fa-trash text-danger"></i> Delete
                                  </button>
                              </form>
                            @endcan

                        </td>
                        
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Order ID</th>
                    {{-- <th>Wholeorder Stock</th> --}}
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
@endsection