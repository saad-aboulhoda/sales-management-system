

@extends('layouts.master')

@section('title', 'المبيعات | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> لائحة المبيعات</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">المبيعات</li>
                <li class="breadcrumb-item active"><a href="#">اللائحة</a></li>
            </ul>
        </div>

        @can('invoice-create')
        <div>
            <a class="btn btn-primary" href="{{route('invoice.create')}}"><i class="fa fa-plus"></i> إنشاء فاتورة جديدة</a>
        </div>
        @endcan

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>المنتج</th>
                                <th>عدد العلب</th>
                                <th>ثمن العلبة</th>
                                <th>المجموع</th>
                                <th>تاريخ البيع</th>
                            </tr>
                            </thead>
                            <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->qty }}</td>
                    <td>{{ $sale->price }}</td>
                    <td>{{ $sale->amount }} درهم</td>
                    <td>{{ $sale->created_at }}</td>

                </tr>
            @endforeach
        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>



@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('/') }}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/ar.json',
            },
        });
    </script>
@endpush
