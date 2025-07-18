@extends('layouts.admin_base2')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      
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
                <span class="bg-red">{{ date("Y-m-d h:i:sa") }}</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-shopping-cart bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> SALE #{{$sale_number}}</span>
                  <h3 class="timeline-header"><a href="#" onclick="event.preventDefault()">Products List</a></h3>

                  <div class="timeline-body">
                    <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body p-0">
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Product Name</th>
                              <th>Product Price</th>
                              <th>Product Quantity</th>
                              <th>Subtotal</th>
                            </tr>
                          </thead>
                          <tbody>
                            <form id="update-empty" action="{{ route('update_cart') }}" method="post">
                              @csrf
                              @foreach ($products as $cart)
                                <tr>
                                  <td>{{$cart['product_id']}} <input type="hidden" name="product_id[]" value="{{$cart['product_id']}}"> </td>
                                  <td>{{$cart['product_name']}} <input type="hidden" name="product_name[]" value="{{$cart['product_name']}}"> </td>
                                  <td>{{$cart['product_price']}} <input type="hidden" name="product_price[]" value="{{$cart['product_price']}}"> </td>
                                  <td> <input class="form-control" min="1" value="{{$cart['product_quantity']}}" type="number" name="product_quantity[]" required> </td>
                                  <td>{{$cart['product_price'] * $cart['product_quantity']}}</td>
                                </tr>
                              @endforeach
                            </form>
                            
                            
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-primary btn-md"
                    onclick="event.preventDefault()
                    document.getElementById('update-empty').submit()
                    "
                    >   Update  </a>
                    {{-- <a href="{{ URL::to('/retail/sales/create') }}" class="btn btn-warning btn-sm">Back to Products</a> --}}
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-money-bill bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i>  SALE #{{$sale_number}}</span>
                  <h3 class="timeline-header no-border"><a href="#">Total</a> # {{$total}}</h3>
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
                    <form action="{{ route('process_sale') }}" method="post">
                      @csrf
                      <select name="payment_method" id="" class="form-control">
                        <option value="cash">Cash</option>
                        <option value="card">card</option>
                        <option value="transfer">Transfer</option>
                        <option value="cheque">Cheque</option>
                        <option value="pos">Pos</option>
                      </select>
                      <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" name="discount" id="" value="0" class="form-control">
                      </div>
                      <input type="hidden" name="total" value="{{$total}}">
                      <input type="hidden" name="cart" value="{{json_encode($products)}}">
                      <input type="hidden" name="sale_number" value="{{$sale_number}}">
                      
                      <div class="timeline-footer">
                        <input class="btn btn-warning btn-sm form-control" type="submit" value="Finish">
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