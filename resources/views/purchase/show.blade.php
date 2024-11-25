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
                                @if ($globalSettings->get('logo'))
                                    <img src="{{ asset('images/logo/' . $globalSettings->get('logo')) }}" alt="logo"
                                         style="width: 100px; height: 100px;">
                                @else
                                    <h2 class="page-header" style="text-transform: uppercase; margin-inline-end: 6px"><i
                                            class="fa fa-file"></i> {{ $globalSettings->get('name') ?? 'Name'  }}</h2>
                                @endif
                            </div>
                            <div class="col-6">
                                <h5 class="text-right">التاريخ: {{ $purchase->created_at->format('Y-m-d') }}</h5>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-4">من
                                <address>
                                    <strong>{{$purchase->supplier->name}}</strong><br>{{$purchase->supplier->address}}<br>{{$purchase->supplier->mobile}}
                                    <br></address>
                            </div>
                            <div class="col-4">إلى
                                <address><strong style="text-transform: uppercase">{{ $globalSettings->get('name') ?? 'الاسم'  }}</strong><br>{{ $globalSettings->get('address') ?? 'العنوان'  }}<br>{{ $globalSettings->get('phone_number') ?? 'رقم الهاتف'  }}<br>{{ $globalSettings->get('email') ?? 'البريد الالكتروني'  }}</address>
                            </div>
                            <div class="col-4"><b>الفاتورة #{{$purchase->id}}</b><br><br></div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>المنتج</th>
                                        <th>عدد العلب</th>
                                        <th>ثمن العلبة</th>
                                        <th>المبلغ</th>
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
                                        <td><b>المجموع</b></td>
                                        <td><b class="total">{{ $purchase->total_price }}</b></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:void(0);"
                                                              onclick="window.print()"><i class="fa fa-print"></i> اطبع</a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

@endsection
@push('js')
@endpush
