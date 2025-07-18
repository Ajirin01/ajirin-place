@extends('layouts.admin_base2')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Category</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header">
            <h3 class="card-title">
              Category Details
            </h3>
            <!-- tools box -->
            <div class="card-tools">
              <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                      title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.card-header -->
          
          <div class="card-body pad">
            <form action="{{ route('categories.store')}}" method="post">
              @csrf
              <div class="mb-3">
                  <div class="form-group">
                      <label>Category Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Category Name">
                  </div>
              </div>
              <div class="mb-3">
                  <div class="form-group">
                      <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input name="status" type="checkbox" class="custom-control-input" id="customSwitch3">
                          <label class="custom-control-label" for="customSwitch3" name="status">Change the Category to active(green) or inactive(red)</label>
                      </div>
                  </div>
              </div>
              <!-- <div class="mb-3"> -->
                  <div class="col-12">
                      <input type="submit" value="submit" class="btn btn-primary form-control">
                  </div>
              <!-- </div> -->
            </form>
          </div>
          
          
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
@endsection