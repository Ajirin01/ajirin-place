@extends('layouts.admin_base2')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Staff</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Staff</li>
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
                <h3 class="card-title">All Staff</h3>
                <a style="float: right" href="{{route('users.create')}}"><h3 class="card-title"></h3></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <h4 class="page-title">Add User</h4>
                            <h4 class="page-title text-center text-success">
                                @if(session('msg'))
                                {{session('msg')}}
                                @endif
                            </h4>
                            <h4 class="page-title text-center text-danger">
                                @if(session('error'))
                                {{session('error')}}
                                @endif
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Username <span class="text-danger">*</span></label>
                                            @if(session('errors'))
                                            <div class="text text-danger">{{session('errors')->first('name')}}*</div>
                                            @endif
                                            <input class="form-control" placeholder="Full Name" type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Email <span class="text-danger">*</span></label>
                                            @if(session('errors'))
                                            <div class="text text-danger">{{session('errors')->first('email')}}*</div>
                                            @endif
                                        <input class="form-control" type="email" placeholder="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Password <span class="text-danger">*</span></label>
                                            @if(session('errors'))
                                            <div class="text text-danger">{{session('errors')->first('password')}}*</div>
                                            @endif
                                        <input class="form-control" type="password"  name="password">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Confirm Password <span class="text-danger">*</span></label>
                                            @if(session('errors'))
                                            <div class="text text-danger">{{session('errors')->first('password')}}*</div>
                                            @endif
                                        <input class="form-control" type="password"  name="password_confirmation">
                                        </div>
                                    </div>
            
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>role <span class="text-danger">*</span></label>
                                            @if(session('errors'))
                                            <div class="text text-danger">{{session('errors')->first('role')}}*</div>
                                            @endif
                                            <select name="role" id="" class="form-control">
                                                <option value="user">user</option>
                                                <option value="admin">admin</option>
                                                <option value="shop assist">shop assist</option>
                                                <option value="retail rep">retail rep</option>
                                                <option value="wholesale rep">wholesale rep</option>

                                                @if (Session::get('sale_type') == 'wholesale')
                                                    <option value="minna order manager">order manager</option>
                                                    <option value="minna product manager">product manager</option>
                                                @else
                                                    <option value="asaba order manager">order manager</option>
                                                    <option value="asaba product manager">product manager</option>
                                                @endif
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <label class="display-block">Status</label>
                                    @if(session('errors'))
                                            <div class="text text-danger">{{session('errors')->first('status')}}*</div>
                                            @endif
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="product_active" value="active" checked>
                                        <label class="form-check-label" for="product_active">
                                        Active
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="product_inactive" value="inactive">
                                        <label class="form-check-label" for="product_inactive">
                                        Inactive
                                        </label>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary submit-btn form-control">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


