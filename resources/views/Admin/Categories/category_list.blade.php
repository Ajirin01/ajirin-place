@extends('layouts.admin_base2')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
                <h3 class="card-title">All Categories</h3>
                <a style="float: right" href="{{route('categories.create')}}"><h3 class="card-title">Add Category</h3></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                      <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->status}}</td>
                        <td>
                            <a class="btn" href="{{ route('categories.edit', $category->id) }}">
                                <i class="fas fa-edit text-warning"></i> Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="post" id="category-id{{$category->id}}">
                              @method('DELETE')
                              @csrf
                            </form>
                            <a class="btn" onclick="event.preventDefault();
                            var nxt =  confirm('Are you sure you want to delete?');
                            if(nxt){
                              document.getElementById('category-id'+{{$category->id}}).submit()
                            }else{
                              ;
                            }
                             ">
                                <i class="fas fa-trash text-danger" ></i> Delete
                            </a>
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