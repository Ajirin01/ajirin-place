<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Phase2 Payment Receipt</title>

    <link href="{{ asset('admin/receipt/bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('admin/receipt/query.js') }}"></script>
    <script src="{{ asset('admin/receipt/dom-to-image.min.js') }}"></script>

    <style>
        .body-main {
            background: #ffffff;
            border-bottom: 15px solid #1E1F23;
            border-top: 15px solid #1E1F23;
            margin-top: 30px;
            margin-bottom: 30px;
            padding: 40px 30px;
            position: relative;
            box-shadow: 0 1px 21px #808080;
            font-size: 10px;
            background-image: url('{{ asset("admin/receipt/logo-trans.png") }}');
            background-position: center;
            background-repeat: no-repeat;
        }

        .main thead {
            background: #1E1F23;
            color: #fff;
        }

        .img {
            height: 50px;
        }

        h1 {
            text-align: center;
        }

        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 2px !important;
        }
    </style>
</head>
<body oncontextmenu="return false">
<div class="container">
    <div class="page-header">
        <h1>Payment Receipt</h1>
    </div>

    <div class="container" id="printout">
        <div class="row">
            <div class="col-md-12 body-main">
                <div class="col-md-12">
                    <!-- Header -->
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img" alt="Payment Receipt" src="{{ asset('admin/receipt/logo.png') }}" />
                        </div>
                        <div class="col-md-8 text-right">
                            <h4 style="color: #F81D2D;"><strong>Ajirin Place</strong></h4>
                            <p>Opp. Mayfair Pharmacy</p>
                            <p>Ile-Ife, Osun State</p>
                            <p>07058508448</p>
                            <p>support@ajirinplace.com</p>
                        </div>
                    </div>
                    <br/>

                    <!-- Title and Number -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>PAYMENT RECEIPT</h3>
                            <h5>{{ $sale['sale_number'] }}</h5>
                        </div>
                    </div>
                    <br/>

                    <!-- Items Table -->
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th><h5>Description</h5></th>
                            <th><h5>Amount</h5></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $formattedTotal = number_format($sale['total'], 2);
                            $formattedDiscount = number_format($sale['discount'], 2);
                            $totalWithDiscount = number_format($sale['total'] - $sale['discount'], 2);
                        @endphp

                        @foreach (json_decode($sale['cart']) as $cart)
                            <tr>
                                <td>
                                    {{-- {{json_encode($cart)}} --}}
                                    {{ $cart->product_name }} (₦{{ number_format($cart->product_price, 2) }} × {{ $cart->product_quantity }}
                                    {{ $cart->product_quantity == 1 ? 'unit' : 'units' }})
                                </td>
                                <td>₦{{ number_format($cart->product_price * $cart->product_quantity, 2) }}</td>
                            </tr>
                        @endforeach

                        <tr style="color: #F81D2D;">
                            <td><strong>Total:</strong></td>
                            <td><strong>₦{{ $formattedTotal }}</strong></td>
                        </tr>

                        <tr>
                            <td><strong>Discount:</strong></td>
                            <td><strong>₦{{ $formattedDiscount }}</strong></td>
                        </tr>

                        <tr style="color: #F81D2D;">
                            <td><strong>Total with Discount:</strong></td>
                            <td><strong>₦{{ $totalWithDiscount }}</strong></td>
                        </tr>

                        <tr>
                            <td><strong>Payment Option:</strong></td>
                            <td><strong>{{ ucfirst($sale['payment_method']) }}</strong></td>
                        </tr>
                        </tbody>
                    </table>

                    <!-- Footer -->
                    <div class="col-md-12">
                        <p><b>Date:</b> {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}</p>
                        <p><b>Sale Rep:</b> {{ $sale['sale_rep'] }}</p>
                        <p><b>Signature:</b> <img class="img" src="{{ asset('admin/receipt/logo.png') }}" alt="Signature"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="page-header">
        <a href="{{ url('/pos/sales/create') }}"><h1>← Back to Sale</h1></a>
    </div>
</div>

<!-- JS for image and print -->
<script src="{{ asset('admin/receipt/bootstrap.min.js') }}"></script>
<script>
    domtoimage.toJpeg(document.getElementById('printout'), { quality: 0.95 })
        .then(function (dataUrl) {
            const el = `<img style="position: absolute; top: 0; width: 100%; height: 100%;" src="${dataUrl}"/>`;

            const display_setting = "toolbar=no,location=no,directories=no,menubar=no,scrollbars=no,width=500,height=1000,left=100,top=25";
            const document_print = window.open("", "", display_setting);
            document_print.document.open();
            document_print.document.write(`<body style="margin: 0; padding: 0;" onload="self.print(); self.close();">${el}</body>`);
            document_print.document.close();
        });
</script>
</body>
</html>
