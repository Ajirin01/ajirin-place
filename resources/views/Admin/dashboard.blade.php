<?php

  setlocale(LC_MONETARY, 'en_US');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Ajirin Place | Dashboard</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/assets/dist/css/adminlte.min.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/summernote/summernote-bs4.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/toastr/toastr.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ url('admin/dashboard') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ url('admin/dashboard') }}" class="nav-link">{{Auth::user()->role}}: {{Auth::user()->name}}</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-primary" data-widget="control-sidebar" data-slide="true" href="#" role="button"><span>Branch: {{strtoupper(Session::get('branch')) === "ASABA" ? "Ile-Ife" : "" }}</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
              class="fas fa-th-large"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('admin/dashboard') }}" class="brand-link">
        <img src="{{asset('admin/assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Ajirin Place</span>
      </a>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ url('admin/dashboard') }}" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            @can('isProductManager')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-shopping-cart"></i>
                  <p>
                    Products
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('products.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Products</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('products.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Product(s)</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('product-bulk-edit')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Products Bulk Edit</p>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-list-alt"></i>
                  <p>
                    Categories
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('categories.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Categories</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('categories.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Categories</p>
                    </a>
                  </li>
                </ul>
              </li>
    
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-list-alt"></i>
                  <p>
                    Brands
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('brands.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Brands</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('brands.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Brand</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endcan

            @can('isShopAssist')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-cart-plus"></i>
                  <p>
                    POS
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('sales.create') }}" class="nav-link text-warning">
                      <i class="far fa-circle nav-icon"></i>
                      <p>New Sale</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('sales.index') }}" class="nav-link text-success">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Sales</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Orders
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'all') }}" class="nav-link text-primary">
                      <i class="far fa-cart nav-icon"></i>
                      <p>All Orders</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'pending') }}" class="nav-link text-warning">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pending</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'cancelled') }}" class="nav-link text-danger">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Cancelled</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'shipped') }}" class="nav-link text-primary">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Shipped</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'completed') }}" class="nav-link text-success">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Completed</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endcan

            @can('isOrderManager')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Orders
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'all') }}" class="nav-link text-primary">
                      <i class="far fa-cart nav-icon"></i>
                      <p>All Orders</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'pending') }}" class="nav-link text-warning">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pending</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'cancelled') }}" class="nav-link text-danger">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Cancelled</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'shipped') }}" class="nav-link text-primary">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Shipped</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'completed') }}" class="nav-link text-success">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Completed</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endcan
            
            @can('isAdmin')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    Staff
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link text-primary">
                      <i class="far fa-cart nav-icon"></i>
                      <p>All Staff</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('users.create') }}" class="nav-link text-warning">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Staff</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endcan

            {{-- <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Wholesale Record
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/forms/general.html" class="nav-link text-warning">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pending</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/forms/advanced.html" class="nav-link text-danger">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rejected</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/forms/advanced.html" class="nav-link text-success">
                    <i class="far fa-circle nav-icon "></i>
                    <p>Approved</p>
                  </a>
                </li>
              </ul>
            </li> --}}
            @can('isSaleRep')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-cart-plus"></i>
                  <p>
                    POS
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('sales.create') }}" class="nav-link text-warning">
                      <i class="far fa-circle nav-icon"></i>
                      <p>New Sale</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('sales.index') }}" class="nav-link text-success">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Sales</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endcan
            

            <li class="nav-item has-treeview">
              <li class="nav-item">
                <form id="logout" style="display: none" action="{{ route('admin-logout') }}" method="post">
                  @csrf
                </form>
                <a href="{{ route('admin-logout') }}" class="nav-link text-danger" 
                onclick="
                event.preventDefault();
                document.getElementById('logout').submit()
                "
                >
                  <i class="fa fa-toggle-off nav-icon"></i>
                  <p>logout</p>
                </a>
              </li>
            </li>

            @can('isAdmin')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-cog"></i>
                  <p>
                    Set Sale Mode
                  </p>
                </a>
                <form id="mc-form" action="{{ route('shopping-setting') }}" method="post" id="shopping-form">
                    @csrf
                    <select class="form-control" name="shopping_type" id="shopping-type">
                        <option value="retail">Retail</option>
                        <option value="wholesale">Wholesale</option>
                    </select>
                    <button class="form-control btn" style="background-color: #d8373e; color: white; font-weight: 600" class="btn" id="mc-submit">set</button>
                </form>
              </li>
            @endcan
          </ul>
          <span class="nav-link text-danger">Operation Mode: {{ strtoupper(substr(Session::get( 'sale_type' ),0, 1)). substr(Session::get( 'sale_type' ), 1, )}}</span>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{Auth::user()->role}}: {{Auth::user()->name}}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">{{Auth::user()->role}}: {{Auth::user()->name}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      {{-- <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">CPU Traffic</span>
            <span class="info-box-number">
              10
              <small>%</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div> --}}
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Products</span>
            <span class="info-box-number">{{ count(($products)) }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      {{-- <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Likes</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col --> --}}

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      

      {{-- @if (Auth::user()->role == 'admin' && Session::get('branch') == 'minna')
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">{{ count(($sales)) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">{{ count(($sales_retail)) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      @endif
      
      @if (Auth::user()->role == 'retail rep' && Session::get('branch') == 'minna')
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">{{ count(($sales_retail)) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      @endif --}}

      @if (Auth::user()->role == 'admin' && Session::get('branch') == 'asaba')
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Sales</span>
            <span class="info-box-number">{{ count(($sales)) }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Orders</span>
              <span class="info-box-number">{{ count(($orders)) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      @endif
      
      {{-- @if (Auth::user()->role == 'wholesale rep' && Session::get('branch') == 'asaba')
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">{{ count(($sales_wholesale)) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      @endif --}}

      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Users</span>
            <span class="info-box-number">{{ count($users) }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Monthly Recap Report</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <p class="text-center">
                  @php
                      try{
                        echo "<strong>Sales: ".$months[0]."-".$months[count($months)-1]."</strong>";
                      }catch(Exception $e){
                        echo "<strong>Sales:   </strong>";
                      }
                  @endphp
                  
                  @if (Auth::user()->role == 'admin' && Session::get('sale_type') == 'retail')
                  <span class="text-danger">Total with wholesale:</span> <strong>N {{ number_format( $sales_total ) }}.00</strong>  | <span class="text-danger">Retail Total:</span> <strong>N {{ number_format($sales_total_retail ) }}.00</strong>  
                  @endif

                  @if (Auth::user()->role == 'admin' && Session::get('sale_type') == 'wholesale')
                     <span class="text-danger">Total with retail:</span> <strong>N {{ number_format( $sales_total ) }}.00</strong>  | <span class="text-danger">Wholeseles Total:</span> <strong>N {{ number_format($sales_total_wholesale ) }}.00</strong>  
                  @endif

                  @if (Auth::user()->role != 'admin' && Session::get('sale_type') == 'retail')
                    <span class="text-danger">Retail Total:</span> <strong>N {{ number_format( $sales_total_retail ) }}.00</strong>  
                  @endif

                  @if (Auth::user()->role != 'admin' && Session::get('sale_type') == 'wholesale')
                     <span class="text-danger">Wholeseles Total:</span> <strong>N {{ number_format( $sales_total_wholesale ) }}.00</strong>  
                  @endif


                </p>

                <div class="chart">
                  <!-- Sales Chart Canvas -->
                  <canvas id="salesChart" height="180" style="height: 300px;"></canvas>
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->
              {{-- <div class="col-md-4">
                <p class="text-center">
                  <strong>Goal Completion</strong>
                </p>

                <div class="progress-group">
                  Add Products to Cart
                  <span class="float-right"><b>160</b>/200</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->

                <div class="progress-group">
                  Complete Purchase
                  <span class="float-right"><b>310</b>/400</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                  </div>
                </div>

                <!-- /.progress-group -->
                <div class="progress-group">
                  <span class="progress-text">Visit Premium Page</span>
                  <span class="float-right"><b>480</b>/800</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width: 60%"></div>
                  </div>
                </div>

                <!-- /.progress-group -->
                <div class="progress-group">
                  Send Inquiries
                  <span class="float-right"><b>250</b>/500</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
              </div> --}}
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->


    <!-- Main row -->
    <div class="row">
      @if (Auth::user()->role == 'admin')
        <!-- Left col -->
        <div class="col-md-8">
          <!-- TABLE: LATEST ORDERS -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Latest Orders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Period</th>
                    <th>Status</th>
                    {{-- <th>Popularity</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                    <input id="products" type="hidden" value="{{json_encode($sale_recap)}}">
                    <input id="months" type="hidden" value="{{json_encode($months)}}">
                    @foreach ($latest_orders as $order)
                      <tr>
                        <td><a href="pages/examples/invoice.html">{{ $order->order_number }}</a></td>
                        <td>{{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</td>
                        @if ($order->status === 'shipped')
                          <td><span class="badge badge-success">{{ $order->status }}</span></td>
                        @endif

                        @if ($order->status === 'pending' || $order->status === 'pay on delivery' || $order->status === 'paid')
                          <td><span class="badge badge-warning">{{ $order->status }}</span></td>
                        @endif

                        @if ($order->status === 'cancelled')
                          <td><span class="badge badge-danger">{{ $order->status }}</span></td>
                        @endif

                        @if ($order->status === 'complete')
                          <td><span class="badge badge-primary">{{ $order->status }}</span></td>
                        @endif

                        @if ($order->status === 'confirmed')
                          <td><span class="badge badge-sucess">{{ $order->status }}</span></td>
                        @endif
                        
                        {{-- <td>
                          <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                        </td> --}}
                      </tr>
                    @endforeach
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              {{-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a> --}}
              <a href="{{ route('orders_by_type', ['all', 'type'=> Session::get('shopping_type')]) }}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

      
        <div class="col-md-4">
          <!-- PRODUCT LIST -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recently Added Products</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                @foreach ($latest_products as $product)
                  <li class="item">
                    <div class="product-img">
                      <img src="{{ asset('public/uploads/'.$product->image) }}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">{{ $product->name }}
                        <span class="badge badge-warning float-right">#{{ $product->price }}</span></a>
                      <span class="product-description">
                        {{ substr($product->description, 100) }}
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                @endforeach
                
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="{{ route('products.index') }}" class="uppercase">View All Products</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
      @endif
      
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!--/. container-fluid -->

      <div style="display: none">
        <button type="button" id="success" class="btn btn-success toastrDefaultSuccess">
            Launch Success Toast
          </button>
        <button type="button" id="error" class="btn btn-danger toastrDefaultError">
            Launch Error Toast
          </button>
          @if (session('errors'))
              <script>
                  var error = document.getElementById('error')
                  console.log(error)
                  error.click()
                  console.log("errors")
              </script>
        
          @endif
          @if (session('success'))
            <script>
                document.getElementById('success').click()
            </script>
              
          @endif
          
      </div>
    </div>
    <!-- /.content-wrapper -->

    

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2020 <a href="https://digi-realm.com.ng.io">Digi-realm</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- DataTables -->
  <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('admin/assets/dist/js/adminlte.js')}}"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="{{asset('admin/assets/dist/js/demo.js')}}"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="{{asset('admin/assets/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/raphael/raphael.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
  {{-- <script src="{{asset('admin/assets/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script> --}}
  <!-- ChartJS -->
  <script src="{{asset('admin/assets/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{asset('admin/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/toastr/toastr.min.js')}}"></script>
  <!-- PAGE SCRIPTS -->
  <script src="{{asset('admin/assets/dist/js/pages/dashboard2.js')}}"></script>
  <!-- Summernote -->
  <script src="{{asset('admin/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
      // Summernote
      $('.textarea').summernote();
    });
  </script>
  <script>
    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      $('.swalDefaultSuccess').click(function() {
        Toast.fire({
          icon: 'success',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultInfo').click(function() {
        Toast.fire({
          icon: 'info',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultError').click(function() {
        Toast.fire({
          icon: 'error',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultWarning').click(function() {
        Toast.fire({
          icon: 'warning',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultQuestion').click(function() {
        Toast.fire({
          icon: 'question',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });

      $('.toastrDefaultSuccess').click(function() {
        toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultInfo').click(function() {
        toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultError').click(function() {
        toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultWarning').click(function() {
        toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });

      $('.toastsDefaultDefault').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultTopLeft').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'topLeft',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultBottomRight').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'bottomRight',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultBottomLeft').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'bottomLeft',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultAutohide').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          autohide: true,
          delay: 750,
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultNotFixed').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          fixed: false,
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultFull').click(function() {
        $(document).Toasts('create', {
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          icon: 'fas fa-envelope fa-lg',
        })
      });
      $('.toastsDefaultFullImage').click(function() {
        $(document).Toasts('create', {
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          image: '../../dist/img/user3-128x128.jpg',
          imageAlt: 'User Picture',
        })
      });
      $('.toastsDefaultSuccess').click(function() {
        $(document).Toasts('create', {
          class: 'bg-success',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultInfo').click(function() {
        $(document).Toasts('create', {
          class: 'bg-info',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultWarning').click(function() {
        $(document).Toasts('create', {
          class: 'bg-warning',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultDanger').click(function() {
        $(document).Toasts('create', {
          class: 'bg-danger',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultMaroon').click(function() {
        $(document).Toasts('create', {
          class: 'bg-maroon',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
    });

  </script>

  <script>
    /* global Chart:false */

    $(function () {
      'use strict'

      /* ChartJS
      * -------
      * Here we will create a few charts using ChartJS
      */

      //-----------------------
      // - MONTHLY SALES CHART -
      //-----------------------

      // Get context with jQuery - using jQuery's .get() method.
      var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
      var products = JSON.parse(document.getElementById('products').value)
      var months = JSON.parse(document.getElementById('months').value)
      // var products = document.getElementById('products').value
      
      console.log(products)

      
      var datasets_array = function(products){ 
        var datasets = []
        var color_code = Math.ceil(Math.random(0,17))*10

        products.forEach(product => {
           datasets.push({
            label: product.name,
            backgroundColor: 'rgba('+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+'0.9)',
            // borderColor: 'rgba(225,225,225,.5)',
            borderColor: 'rgba('+Number(Math.ceil(Math.random(10,20)*200))+','+Number(Math.ceil(Math.random(10,20)*200))+','+Number(Math.ceil(Math.random(10,20)*200))+','+.5+')',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba('+Number(color_code+Math.ceil(Math.random(10,20)*100)-10)+','+Number(color_code+Math.ceil(Math.random(10,20)*100)-40)+','+Number(color_code+Math.ceil(Math.random(10,20)*100)-20)+','+'1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba('+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+'1)',
            data: product.data
          })
          color_code += 10;
        });
        return datasets
      }
      

      var salesChartData = {
        labels: months,
        datasets: datasets_array(products)
      }

      var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false
            }
          }],
          yAxes: [{
            gridLines: {
              display: false
            }
          }]
        }
      }

      // This will get the first returned node in the jQuery collection.
      // eslint-disable-next-line no-unused-vars
      var salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: salesChartData,
        options: salesChartOptions
      }
      )

      //---------------------------
      // - END MONTHLY SALES CHART -
      //---------------------------

      //-------------
      // - PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieData = {
        labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator'
        ],
        datasets: [
          {
            data: [700, 500, 400, 600, 300, 100],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
          }
        ]
      }
      var pieOptions = {
        legend: {
          display: false
        }
      }
      // Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      // eslint-disable-next-line no-unused-vars
      var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
      })

      //-----------------
      // - END PIE CHART -
      //-----------------

      /* jVector Maps
      * ------------
      * Create a world map with markers
      */
      $('#world-map-markers').mapael({
        map: {
          name: 'usa_states',
          zoom: {
            enabled: true,
            maxLevel: 10
          }
        }
      })
      
    })

  </script>

</body>
</html>
