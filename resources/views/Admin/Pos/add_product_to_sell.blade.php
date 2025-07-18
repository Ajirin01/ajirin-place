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
                <h3 class="card-title">All Products</h3>
                <a style="float: right" href="" onclick="event.preventDefault()"><h3 class="card-title">SALE# {{$sale_number}}</h3></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('add_product_to_sell') }}" method="post">
                    @csrf
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th width="100px">Quantity</th>
                            <th>Price</th>
                            <th>Add</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($products as $product)
                            <tr> 
                                <td>{{$product->id}} <input id="product-id{{$product->id}}" type="hidden"  value="{{$product->id}}"></td>
                                <td>{{$product->name}} <input id="product-name{{$product->id}}" type="hidden"  value="{{$product->name}}"></td>
                                <td width="100px"><input id="product-quantity{{$product->id}}" class="form-control" min="1" type="number"  id="" onchange="getQuantity({{$product->id}})" value="1" required></td>
                                <td>
                                  {{Session::get('sale_type') == 'retail'? $product->price : $product->wholesale_price}} 
                                  <input id="product-price{{$product->id}}" type="hidden"  value="{{Session::get('sale_type') == 'retail'? $product->price : $product->wholesale_price}}">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="add{{$product->id}}" onclick="return checkall('selector[]',{{$product->id}});">
                                </td>
                            </tr>

                            @endforeach

                            <input type="text" name="cart" id="cart" style="display: none">

                            <input id="continue-btn" class="btn btn-primary form-control" type="submit" value="Continue">
                            
                            
                            {{-- <input id="continue-btn" class="btn btn-primary form-control" type="submit" value="Continue" onclick="showData()"> --}}

                        
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Add</th>
                        </tr>
                        </tfoot>
                    
                    </table>
                </form>
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
      var continue_btn= document.getElementById('continue-btn')
      continue_btn.style.display = 'none'
      var cart = document.getElementById('cart')
      var data = {}
      var data_array = []

      function getQuantity(id){
        var check_item = document.getElementById('add'+id)
        var product_id = document.getElementById('product-id'+id)
        var product_price = document.getElementById('product-price'+id)
        var product_name = document.getElementById('product-name'+id)
        var product_quantity = document.getElementById('product-quantity'+id)

        // const data_array_copy = data_array.map(da => {
        // da.product_id === product_id.value?
        // {...da, product_quantity: product_quantity.value } : da
        // console.log(da.product_id === product_id.value)
        // console.log(da)
        // })

        //Find index of specific object using findIndex method.    
        data_array_index = data_array.findIndex((obj => obj.product_id == product_id.value));

        //Log object to Console.
        // console.log("Before update: ", data_array[data_array_index])

        //Update object's name property.
        try {
          data_array[data_array_index].product_quantity = product_quantity.value
        } catch (error) {
          
        }

        //Log object to console again.
        // console.log("After update: ", data_array[data_array_index])
        // data_array = [...data_array, data_array[data_array_index]]

        // const data_array_copy = data_array.map(da =>
        //    console.log(da.product_id)
        // )
        // const data_array_copy = data_array.forEach(da => {
        //   console.log(da.product_quantity)
        // });

        // console.log('quantity', product_quantity.value)
        console.log(data_array)
        cart.value = JSON.stringify(data_array)

      }

      function checkall(selector,id){
          console.log("add"+id)
          var check_item = document.getElementById('add'+id)
          var product_id = document.getElementById('product-id'+id)
          var product_price = document.getElementById('product-price'+id)
          var product_name = document.getElementById('product-name'+id)
          var product_quantity = document.getElementById('product-quantity'+id)

          // cart.name = "cart"
          
          console.log(id+ " is now " +check_item.checked + " quantity " + product_quantity.value)
          if (check_item.checked == true) {
              // product_id.name = "product_id[]"
              // product_price.name = "product_price[]"
              // product_name.name = "product_name[]"
              // product_quantity.name = "product_quantity[]"

              data['product_id'] = product_id.value
              data['product_price'] = product_price.value
              data['product_name'] = product_name.value
              data['product_quantity'] = product_quantity.value

              data_array = [...data_array, data]

              data = {}
              // data_array.push(data)
              
          } else {
              // product_id.name = ""
              // product_price.name = ""
              // product_name.name = ""
              // product_quantity.name = ""
              data_array = data_array.filter(arr => arr.product_id !== product_id.value )
              // if(data_array.length == 0){
              //   continue_btn.style.display = 'none'
              // }else{
              //   continue_btn.style.display = 'block'
              // }
              
          }

          if(data_array.length == 0){
            continue_btn.style.display = 'none'
          }else{
            continue_btn.style.display = 'block'
          } 

          console.log(data_array)
          cart.value = JSON.stringify(data_array)
          console.log(cart.value)
      }

      function showData(){
        event.preventDefault()

        console.log(data)
      }

      
    </script>
@endsection