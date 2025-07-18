@extends('layouts.admin_base2')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brands</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
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
                <h3 class="card-title">All Brands</h3>
                <a style="float: right" href="{{route('brands.create')}}"><h3 class="card-title">Add Brand</h3></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Brand Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($brands as $brand)
                      <tr>
                        <td>{{$brand->name}}</td>
                        <td>{{$brand->status}}</td>
                        <td>
                            <a class="btn" href="{{ route('brands.edit', $brand->id) }}">
                                <i class="fas fa-edit text-warning"></i> Edit
                            </a>
                            <form action="{{ route('brands.destroy', $brand->id) }}" method="post" id="brand-id{{$brand->id}}">
                              @method('DELETE')
                              @csrf
                            </form>
                            <a class="btn" onclick="event.preventDefault();
                            var nxt =  confirm('Are you sure you want to delete?');
                            if(nxt){
                              document.getElementById('brand-id'+{{$brand->id}}).submit()
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
                    <th>Category Name</th>
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