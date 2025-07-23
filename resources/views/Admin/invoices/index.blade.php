@extends('layouts.admin_base2')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoices</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Invoices</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Invoices</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Invoice Code</th>
                      <th>Customer</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $invoice->invoice_code }}</td>
                      <td>{{ $invoice->customer_name ?? 'Guest' }}</td>
                      <td>₦{{ number_format($invoice->total, 2) }}</td>
                      <td>
                        @if($invoice->status == 'paid')
                          <span class="badge badge-success">Paid</span>
                        @elseif($invoice->status == 'pending')
                          <span class="badge badge-warning">Pending</span>
                        @else
                          <span class="badge badge-secondary">{{ ucfirst($invoice->status) }}</span>
                        @endif
                      </td>
                      <td>{{ $invoice->created_at->format('M d, Y') }}</td>
                      <td>
                        <a href="{{ route('invoices.show', $invoice->invoice_code) }}" class="btn btn-sm btn-primary">
                          <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('invoices.download', $invoice->invoice_code) }}" class="btn btn-sm btn-secondary">
                          <i class="fas fa-download"></i> PDF
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Invoice Code</th>
                      <th>Customer</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
