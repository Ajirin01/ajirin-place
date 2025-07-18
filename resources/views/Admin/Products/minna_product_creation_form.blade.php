@extends('layouts.admin_base2')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Product</li>
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
               {{ strtoupper(substr(Session::get( 'sale_type' ),0, 1)). substr(Session::get( 'sale_type' ), 1, )}} Product Details
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
                <form action="{{ route('products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Product Sale Type</label>
                            <select name="sale_type" class="form-control">
                                <option value="">please select or leave empty</option>
                                <option value="new_products">new product</option>
                                <option value="new_arrival">new arrival</option>
                                <option value="hot_deal">hot deal</option>
                                <option value="hot_sale">hot sale</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Brand</label>
                            <select name="brand_id" class="form-control">
                                <option value="">select brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  <div class="mb-3">
                      <div class="form-group">
                          <label>Product Name</label>
                          <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Product Name">
                      </div>
                  </div>
                  <div class="md-3">
                    <label for="exampleInputFile">Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                      <label>Please Fill price, stock and size for wholesale</label><br>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <input name="wholesale" type="checkbox" checked>
                              </span>
                          </div>
                          <input name="wholesale_price" type="text" placeholder="wholesale price" value="{{ old('wholesale_price') }}" class="form-control">
                          <input name="wholesale_size" type="text" placeholder="wholesale size" value="{{ old('wholesale_size') }}" class="form-control">
                          <select name="wholesale_quantity" class="form-control" value="{{ old('wholesale_quantity') }}">
                            <option value="sachet">sachet</option>
                            <option value="bottle">bottle</option>
                            <option value="card">card</option>
                            <option value="ampoule">ampoule</option>
                            <option value="tube">tube</option>
                            <option value="pack">pack</option>
                            <option value="tablet">tablet</option>
                            <option value="box">box</option>
                            <option value="tin">tin</option>
                            <option value="piece(s)">piece(s)</option>
                            <option value="infusion">infusion</option>
                            <option value="vail">vail</option>
                            <option value="capsule">capsule</option>
                          </select>
                          <input name="wholesale_stock" type="number" min="0" placeholder="wholesale stock" value="{{ old('wholesale_stock') }}" class="form-control">
                          <select name="wholesale_stock_quantity" class="form-control">
                            <option value="sachet">sachet</option>
                            <option value="bottle">bottle</option>
                            <option value="card">card</option>
                            <option value="ampoule">ampoule</option>
                            <option value="tube">tube</option>
                            <option value="pack">pack</option>
                            <option value="tablet">tablet</option>
                            <option value="box">box</option>
                            <option value="tin">tin</option>
                            <option value="piece(s)">piece(s)</option>
                            <option value="infusion">infusion</option>
                            <option value="vail">vail</option>
                            <option value="capsule">capsule</option>
                          </select>
                      </div>
                  </div>
                  <div class="mb-3">
                      <label>Prouduct Description</label>
                      <textarea name="description" class="textarea" placeholder="Place some text here"
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('description')}}</textarea>
                  </div>
                  <div class="mb-3">
                      <div class="form-group">
                          <label>Shipping Price</label>
                          <input type="text" class="form-control" name="shipping_price" placeholder="Enter ...">
                      </div>
                  </div>
                  <div class="mb-3">
                      <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                              <input name="status" type="checkbox" class="custom-control-input" id="customSwitch3">
                              <label class="custom-control-label" for="customSwitch3">Change the product to active(green) or inactive(red)</label>
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