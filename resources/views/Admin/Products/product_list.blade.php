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
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                <h3 class="card-title">All Products</h3>
                <a style="float: right" href="{{route('products.create')}}"><h3 class="card-title">Add Product</h3></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Product Nanme</th>
                    {{-- <th>Wholesale Stock</th> --}}
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        {{-- <td>{{$product->wholesale_stock}}</td> --}}
                        <td>
                          {{Session::get('sale_mode') == 'retail' ? $product->stock : $product->wholesale_stock}}
                          @if((Session::get('sale_mode') == 'retail' ? $product->stock : $product->wholesale_stock) < 5)
                            (<span style="color: red">stock level below 5</span>)
                          @endif
                        </td>
                        <td>{{$product->status}}</td>
                        <td>
                            <a class="btn" href="{{ route('products.edit', $product->id) }}">
                                <i class="fas fa-edit text-warning"></i> Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post" id="product-id{{$product->id}}">
                              @method('DELETE')
                              @csrf
                            </form>
                            <a class="btn" onclick="event.preventDefault();
                            var nxt =  confirm('Are you sure you want to delete?');
                            if(nxt){
                              document.getElementById('product-id'+{{$product->id}}).submit()
                            }else{
                              ;
                            }
                             ">
                                <i class="fas fa-trash text-danger" ></i> Delete
                            </a>
                            {{-- <a class="btn">
                                <i class="fas fa-pause"></i> Pause
                            </a> --}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Product Nanme</th>
                    {{-- <th>Wholesale Stock</th> --}}
                    <th>Stock</th>
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