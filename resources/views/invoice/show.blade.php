@extends('layouts.master')

@section('title', 'فاتورة | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-file-text-o"></i> فاتورة بيع</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">الفواتير</a></li>
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
                                    <h2 class="page-header" style="text-transform: uppercase; margin-inline-end: 6px"><i class="fa fa-file"></i> {{ $globalSettings->get('name') ?? 'Name'  }}</h2>
                                @endif

                            </div>
                            <div class="col-6">
                                <h5 class="text-right">تاريخ الفاتورة: {{$invoice->created_at->format('Y-m-d')}}</h5>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-4">من
                                <address><strong style="text-transform: uppercase">{{ $globalSettings->get('name') ?? 'الاسم'  }}</strong><br>{{ $globalSettings->get('address') ?? 'العنوان'  }}<br>{{ $globalSettings->get('phone_number') ?? 'رقم الهاتف'  }}<br>{{ $globalSettings->get('email') ?? 'البريد الالكتروني'  }}</address>
                            </div>
                            <div class="col-4">إلى
                                <address>
                                    <strong>{{$invoice->customer->name}}</strong><br>{{$invoice->customer->address}}<br>{{$invoice->customer->mobile}}
                                    <br>{{$invoice->customer->email}}</address>
                            </div>
                            <div class="col-4"><b>الفاتورة #{{1000+$invoice->id}}</b><br><br></div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>المنتج</th>
                                        <th>عدد العلب</th>
                                        <th>ثمن العلبة</th>
                                        <th>تخفيض</th>
                                        <th>المبلغ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <div style="display: none">
                                        {{$total=0}}
                                    </div>
                                    @foreach($sales as $sale)
                                        <tr>
                                            <td>{{$sale->product->name}}</td>
                                            <td>{{$sale->qty}} علبة</td>
                                            <td>{{$sale->price}} درهم</td>
                                            <td>{{$sale->dis}}%</td>
                                            <td>{{$sale->amount}} درهم</td>
                                            <div style="display: none">
                                                {{$total +=$sale->amount}}
                                            </div>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>المجموع</b></td>
                                        <td><b class="total">{{$total}} درهم</b></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:void(0);"
                                                              onclick="printInvoice();"><i class="fa fa-print"></i>
                                    اطبع</a></div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>


    <script>
        function printInvoice() {
            window.print();
        }
    </script>

@endsection
@push('js')
@endpush





