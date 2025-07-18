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
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Sales</h3>
                <a style="float: right" href="{{route('sales.create')}}"><h3 class="card-title">Add Product</h3></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sale Code</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Sale Type</th>
                    {{-- <th>Status</th> --}}
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($sales as $sale)
                    <tr>
                        <td>{{$sale->sale_number}}</td>
                        <td>{{$sale->total - $sale->discount}}</td>
                        <td>{{$sale->payment_method}}</td>
                        {{-- <td>{{$sale->sale_type}}</td> --}}
                        <td>{{$sale->status}}</td>
                        <td>
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="post" id="sale-id{{$sale->id}}">
                              @method('DELETE')
                              @csrf
                            </form>
                            @can("isAdmin")
                              <a class="btn" onclick="event.preventDefault();
                                var nxt =  confirm('Are you sure you want to delete?');
                                if(nxt){
                                  document.getElementById('sale-id'+{{$sale->id}}).submit()
                                }else{
                                  ;
                                }
                              ">
                                  <i class="fas fa-trash text-danger" ></i> Delete
                              </a>
                            @endcan
                            
                            <a class="btn" href="{{ route('sales.show', $sale->id) }}">
                                <i class="fas fa-eye text-primary"></i> View
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
                    <th>Sale Code</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    {{-- <th>Sale Type</th> --}}
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

    <script>
      
    </script>
@endsection