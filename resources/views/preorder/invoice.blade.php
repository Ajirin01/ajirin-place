@extends('layouts.site_base')

@section('content')
<!-- Invoice area start -->
<div class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">

                <!-- Download Button -->
                <div class="text-end mb-3">
                    <button onclick="downloadInvoice()" class="btn btn-primary">
                        Download PDF
                    </button>
                </div>

                <div id="invoice-area" class="card shadow border-0">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="mb-0">Invoice</h3>
                            <div>
                                <strong>Invoice Code:</strong> {{ $order->invoice_code }}
                            </div>
                        </div>

                        <!-- Customer Details -->
                        <div class="mb-4">
                            <h5>Customer Info</h5>
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td><strong>Name:</strong></td>
                                        <td>{{ $order->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone:</strong></td>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            <span class="badge 
                                                {{ 
                                                    $order->status === 'completed' ? 'badge-success' :
                                                    ($order->status === 'pending' ? 'badge-warning' :
                                                    ($order->status === 'invoiced' ? 'badge-primary' :
                                                    ($order->status === 'declined' ? 'badge-danger' : 'badge-secondary')) 
                                                ) }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Product Info -->
                        <div class="mb-4">
                            <h5>Product / Request Description</h5>
                            <p class="border rounded p-3 bg-white">
                                {!! nl2br(e($order->product_details)) !!}
                            </p>
                        </div>

                        <!-- Amount -->
                        <div class="d-flex justify-content-end mb-4">
                            <table class="table table-bordered w-50">
                                <tbody>
                                    <tr>
                                        <th>Estimated Cost</th>
                                        <td>₦{{ number_format($order->estimated_cost ?? 0, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Footer -->
                        <div class="text-center mt-5">
                            <a href="{{ route('home') }}" class="btn btn-secondary">← Back to Home</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- html2pdf.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    function downloadInvoice() {
        const invoice = document.getElementById("invoice-area");
        html2pdf().from(invoice).set({
            margin: 0.5,
            filename: '{{ $order->invoice_code ?? "invoice" }}.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        }).save();
    }
</script>
@endsection
