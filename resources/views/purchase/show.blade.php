@extends('layouts.master')

@section('title', 'فاتورة الشراء | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-file-text-o"></i> فاتورة شراء</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">فواتير الشراء</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h2 class="page-header"><i class="fa fa-globe"></i> Sales ERP</h2>
                            </div>
                            <div class="col-6">
                                <h5 class="text-right">Date: {{ $purchase->created_at->format('Y-m-d') }}</h5>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-4">From
                                <address><strong>Sales ERP.</strong><br>Tongi<br>Gazipur<br>Email: hello@saleserp.com
                                </address>
                            </div>
                            <div class="col-4">To
                                <address>
                                    <strong>{{ $purchase->supplier->name }}</strong><br>{{ $purchase->supplier->address }}<br>Phone:
                                    {{ $purchase->supplier->mobile }}<br>Email: {{ $purchase->supplier->email }}
                                </address>
                            </div>
                            <div class="col-4"><b>Purchase #{{ $purchase->id }}</b><br><br><b>Order ID:</b>
                                4F3S8J<br><b>Payment Due:</b> {{ $purchase->purchase_date }}<br><b>Account:</b> 968-34567
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchase->products as $product)
                                            <tr>
                                                <td>{{ $product->product->name }}</td>
                                                <td>{{ $product->box_qty }}</td>
                                                <td>{{ $product->box_price }}</td>
                                                <td>{{ $product->total_price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><b>Total</b></td>
                                            <td><b class="total">{{ $purchase->total_price }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();"
                                    target="_blank"><i class="fa fa-print"></i> Print</a></div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

@endsection
@push('js')
@endpush
