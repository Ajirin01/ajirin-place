@extends('layouts.admin_base2')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Preorders</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Preorders</li>
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
            <h3 class="card-title">All Preorders</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Customer</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Items</th>
                  <th>Estimated Cost</th>
                  <th>Status</th>
                  <th>Invoice</th>
                  <th>Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($preorders as $order)
                <tr>
                  <td>{{ $order->name }}</td>
                  <td>{{ $order->email }}</td>
                  <td>{{ $order->phone }}</td>
                  <td>
                    @php
                      $items = json_decode($order->product_details, true);
                    @endphp
                    @if(is_array($items))
                      <ul class="pl-3 mb-0">
                        @foreach($items as $item)
                          <li>{{ $item['name'] ?? 'Unnamed Item' }} × {{ $item['quantity'] ?? 1 }}</li>
                        @endforeach
                      </ul>
                    @else
                      {{ $order->product_details }}
                    @endif
                  </td>
                  <td>₦{{ number_format($order->estimated_cost ?? 0, 2) }}</td>
                  <td>
                    @php
                        switch ($order->status) {
                            case 'pending':
                            $badgeClass = 'badge-warning';
                            break;
                            case 'invoiced':
                            $badgeClass = 'badge-primary';
                            break;
                            case 'processing':
                            $badgeClass = 'badge-info';
                            break;
                            case 'completed':
                            $badgeClass = 'badge-success';
                            break;
                            case 'declined':
                            $badgeClass = 'badge-danger';
                            break;
                            default:
                            $badgeClass = 'badge-secondary';
                        }
                    @endphp

                    <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                  </td>
                  <td>{{ $order->invoice_code }}</td>
                  <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                  <td>
                    <a class="btn btn-sm" href="{{ route('admin.preorders.show', $order->id) }}">
                      <i class="fas fa-eye text-primary"></i> View
                    </a>
                    <form action="{{ route('admin.preorders.delete', $order->id) }}" method="POST" id="preorder-id{{ $order->id }}" class="d-inline">
                      @csrf
                      @method('DELETE')
                    </form>
                    <a class="btn btn-sm" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this preorder?')) { document.getElementById('preorder-id{{ $order->id }}').submit(); }">
                      <i class="fas fa-trash text-danger"></i> Delete
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Customer</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Items</th>
                  <th>Estimated Cost</th>
                  <th>Status</th>
                  <th>Invoice</th>
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
