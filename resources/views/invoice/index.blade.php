@extends('layouts.master')

@section('titel', 'Invoice | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> لائحة الفواتير</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">الفواتير</li>
                <li class="breadcrumb-item active"><a href="#">اللائحة</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @can('invoice-create')
            <div>
                <a class="btn btn-primary" href="{{ route('invoice.create') }}"><i class="fa fa-plus"></i> إنشاء فاتورة
                    جديدة</a>
            </div>
        @endcan

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>رقم التعريفي</th>
                                <th>الزبون</th>
                                <th>تاريخ البيع</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($invoices as $invoice)
                                <tr style="@if ($invoice->status) background-color: #28a74545; @else background-color: #dc354545; @endif">
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->customer->name }}</td>
                                    <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @can('invoice-show')
                                            <a class="btn btn-info btn-sm"
                                               href="{{ route('invoice.show', $invoice->id) }}"><i
                                                    class="fa fa-eye m-0"></i></a>
                                        @endcan
                                        @can('invoice-cancel')
                                            <button class="btn btn-danger btn-sm waves-effect" type="submit"
                                                    onclick="deleteTag({{ $invoice->id }})">
                                                <i class="fa fa-times m-0"></i>
                                            </button>
                                            <form id="delete-form-{{ $invoice->id }}"
                                                  action="{{ route('invoice.destroy', $invoice->id) }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                    </td>
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

@component('components.tablejs')
@endcomponent
@component('components.sweetalertjs')
@endcomponent
