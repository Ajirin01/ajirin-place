@php
    Use Carbon\Carbon;
@endphp
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Phase2 Payment Receipt</title>
        {{-- <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script> --}}

        <link href="{{ asset('admin/receipt/bootstrap.css') }}" rel='stylesheet'>
        <link href="{{ asset('admin/receipt/fonts/fontawesome-webfont3e6e.ttf') }}" rel='stylesheet'>
        {{-- <script type='query.js'></script> --}}
        <script src="{{ asset('admin/receipt/query.js') }}"></script>
        <script src="{{ asset('admin/receipt/dom-to-image.min.js') }}"></script>

        <style> 
            .body-main {
                background: #ffffff;
                border-bottom: 15px solid #1E1F23;
                border-top: 15px solid #1E1F23;
                margin-top: 30px;
                margin-bottom: 30px;
                padding: 40px 30px !important;
                position: relative;
                box-shadow: 0 1px 21px #808080;
                font-size: 10px;
                background-image: url('{{ asset("admin/receipt/logo-trans.png") }}');
                /*background-size: cover;*/
                background-position: center;
                background-repeat: no-repeat;
                
            }

            .main thead {
                background: #1E1F23;
                color: #fff
            }

            .img {
                height: 50px
            }

            h1 {
                text-align: center
            }

            .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
                padding: 2px !important
            }
            
    </style>
</head>
<body oncontextmenu='return false' class='snippet-body'>
    <div class="container">
    <div class="page-header">
        <h1>Payment Receipt</h1>
    </div>
    {{-- @php
        // echo Carbon::now();
    @endphp --}}
    <div class="container" id="printout">
        <div class="row">
            <div class="col-md-12 body-main">
                <div class="col-md-12">
                    <div class="row">
                        <!-- <divclass="col-md-4"> <img class="img" alt="Invoce Template" src="http://pngimg.com/uploads/shopping_cart/shopping_cart_PNG59.png') }}" /> </div> -->
                        <div class="col-md-4"> <img class="img" alt="Payment Receipt" src="{{ asset('admin/receipt/logo.png') }}" /> </div>
                        <div class="col-md-8 text-right">
                            <h4 style="color: #F81D2D;"><strong>Phase2 Pharmacy</strong></h4>
                            <p>Mallam Habeeb Plaza, Muaza Moh'd road<br> Opp. Old Secretariat Along Old Airport road<br> Minna, Niger State</p>
                            <p>08162519465</p>
                            <p>Support@Phase2.Com</p>
                        </div>
                    </div> <br />
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>PAYMENT RECEIPT</h3>
                            <h5>{{$sale['sale_number']}}</h5>
                        </div>
                    </div> <br />
                    <div>
                        <table class="table table-sm" style="line-height: .5">
                            <thead>
                                <tr>
                                    <th>
                                        <h5>Description</h5>
                                    </th>
                                    <th>
                                        <h5>Amount</h5>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (json_decode($sale['cart']) as $cart)            
                                    <tr>
                                        <td class="col-md-9">{{$cart->product_name}} (#{{ $cart->product_price }} x {{$cart->product_quantity}}
                                            @if ($cart->product_quantity == 1)
                                                unit
                                            @else
                                                units
                                            @endif
                                            )</td>
                                        <td class="col-md-3"><i class="fas fa-rupee-sign" area-hidden="true"></i> {{$cart->product_price * $cart->product_quantity}} </td>
                                    </tr>
                                @endforeach
                                
                                {{-- <tr>
                                    <td class="text-right">
                                        <p> <strong>Total Amount: </strong> </p>
                                    </td>
                                    <td>
                                        <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> {{$sale['total']}} </strong> </p>
                                    </td>
                                </tr> --}}
                                <tr style="color: #F81D2D; font-size: .5rem;">
                                    <td class="text-left">
                                        <h6><strong>Total:</strong></h6>
                                    </td>
                                    <td class="text-left">
                                        <h6><strong><i class="fas fa-rupee-sign" area-hidden="true"></i> {{$sale['total']}} </strong></h6>
                                    </td>
                                    
                                </tr>

                                <tr>
                                    <td class="text-left">
                                        <h6><strong>Discount:</strong></h6>
                                    </td>
                                    <td class="text-left">
                                        <h6><strong><i class="fas fa-rupee-sign" area-hidden="true"></i> {{ $sale['discount'] }} </strong></h6>
                                    </td>
                                </tr>

                                <tr style="color: #F81D2D;">
                                    <td class="text-left">
                                        <h6><strong>Total with discount:</strong></h6>
                                    </td>
                                    <td class="text-left">
                                        <h6><strong><i class="fas fa-rupee-sign" area-hidden="true"></i> {{$sale['total']-$sale['discount']}} </strong></h6>
                                    </td>
                                    
                                </tr>

                                <tr style="color: #F81D2D;">
                                    <td class="text-left">
                                        <h6><strong>Payment Option:</strong></h6>
                                    </td>
                                    <td class="text-left">
                                        <h6><strong><i class="fas fa-rupee-sign" area-hidden="true"></i> {{$sale['payment_method']}} </strong></h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <div class="col-md-12">
                            <p><b>Date :</b> {{Carbon::now()}}</p> <br />
                            <p><b>Sale Rep :</b> {{$sale['sale_rep']}}</p> <br>
                            <p><b>Signature :</b> <img class="img" alt="Payment Receipt" src="{{ asset('admin/receipt/logo.png') }}" /></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-header">
        <a href="{{ URL::to('/pos/sales/create') }}"><h1>Back to sale</h1></a>
    </div>
</div>
    {{-- <script type='text/javascript' src="{{ asset('bootstrap.min.js') }}"></script> --}}
    <script type='text/javascript' src="{{ asset('admin/receipt/bootstrap.min.js') }}"></script>
    <script> 
            domtoimage.toJpeg(document.getElementById('printout'), { quality: 0.95 })
            .then(function (dataUrl) {
            var el = "<img style='position: absolute; top: 0px; width: 100%; height: 100%' src='"+dataUrl+"'/>";
            
            var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
            display_setting+="scrollbars=no,width=500, height=1000, left=100, top=25";  
            //   var tableData = '<table border="1">'+document.getElementsByTagName('table')[0].innerHTML+'</table>';
            // var content_innerhtml = document.getElementById("printout").innerHTML;  
            var document_print=window.open("","",display_setting); 
            // console.log(document_print);
            document_print.document.open();  
            document_print.document.write('<body style="width: 400px; height: 550px; font-family:verdana; font-size: 5pt; margin-top: 2cm; " onLoad="self.print(); self.close();" >');  
            document_print.document.write(el);  
            document_print.document.write('</body></html>');  
            // console.log(document_print.document.getElementsByTagName('img')[0].style.padding == "");
            // document_print.print();  
            document_print.document.close();
            // document_print.close(); 
            });
    </script>
    </body>
</html>