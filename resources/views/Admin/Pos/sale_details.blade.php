@extends('layouts.admin_base2')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sale</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sale</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sale Summary</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Sale Summary</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">{{ $sale->created_at }}</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-shopping-cart bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> SALE #{{$sale->sale_number}}</span>
                  <h3 class="timeline-header"><a href="#" onclick="event.preventDefault()">Sale List</a></h3>

                  <div class="timeline-body">
                    <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body p-0">
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Product Name</th>
                              <th>Product Price (Naira)</th>
                              <th>Product Quantity</th>
                              <th>Subtotal</th>
                            </tr>
                          </thead>
                          <tbody>
                            {{-- {{$sale_cart}} --}}
                            <form id="update-empty" action="{{ route('sales.update', $sale->id) }}" method="post">
                              @method('PATCH')
                              @csrf
                              
                              @foreach ($sale_cart as $cart)
                              
                                <tr>
                                  <td>{{$cart->product_id}}</td>
                                  <td>{{$cart->product_name}}</td>
                                  <td>{{$cart->product_price}}</td>
                                  <td>{{$cart->product_quantity}}</td>
                                  <td>{{$cart->product_price * $cart->product_quantity}}</td>
                                </tr>
                              @endforeach
                            </form>
                            
                            
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-money-bill bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i>  DISCOUNT #{{$sale->discount}}</span>
                  <h3 class="timeline-header no-border"><a href="#">Total</a> # {{$sale->total}}</h3>
                  <h3 class="timeline-header no-border text-danger"><a href="#" class="text-danger">Total AFTER DISCOUNT</a> # {{$sale->total - $sale->discount}}</h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-shipping-fast bg-yellow"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-money-bill"></i> payment methods</span>
                  <h3 class="timeline-header"><a href="#">Payment Method</a></h3>
                  {{-- <div class="timeline-body"> --}}
                    <form action="{{ route('sales.update', $sale->id) }}" method="post">
                      @method('PATCH')
                      @csrf
                      <select disabled name="payment_method" id="" class="form-control">
                        <option value="{{$sale->payment_method}}">{{$sale->payment_method}}</option>
                        
                      </select>
                      <h3 class="timeline-header"><a href="#">Status</a></h3>
                      <select name="status" id="" class="form-control">
                        <option value="{{ $sale->status }}">{{ $sale->status }}</option>
                        <option value="confirmed">confirmed</option>
                        <option value="revoked">revoked</option>
                      </select>
                      <div class="timeline-footer">
                        <input class="btn btn-warning btn-sm form-control" type="submit" value="update">
                        {{-- <a class="btn btn-warning btn-sm">Finish</a> --}}
                      </div>
                    </form>
                    
                  {{-- </div> --}}
                  
                </div>
              </div>
              <!-- END timeline item -->
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection