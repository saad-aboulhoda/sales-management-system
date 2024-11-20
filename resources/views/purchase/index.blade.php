@extends('layouts.master')

@section('title', 'المشتريات | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> إدارة المشتريات</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">المشتريات</li>
                <li class="breadcrumb-item active"><a href="#">الإدارة</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @can('purchase-create')
            <div>
                <a class="btn btn-primary" href="{{ route('purchase.create') }}"><i class="fa fa-shopping-cart"></i>
                    شراء</a>
            </div>
        @endcan

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>الرقم التعريفي</th>
                                <th>المورد</th>
                                <th>تاريخ الشراء</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($purchases as $purchase)
                                <tr
                                    style="@if ($purchase->status) background-color: #28a74545; @else background-color: #dc354545; @endif">
                                    <td>{{ $purchase->id }}</td>
                                    <td>{{ $purchase->supplier->name }}</td>
                                    <td>{{ $purchase->purchase_date }}</td>
                                    <td>
                                        @can('purchase-show')
                                            <a class="btn btn-info btn-sm"
                                               href="{{ route('purchase.show', $purchase->id) }}"><i
                                                    class="fa fa-eye m-0"></i></a>
                                        @endcan
                                        @can('purchase-cancel')
                                            @if ($purchase->status)
                                                <button class="btn btn-danger btn-sm waves-effect" type="submit"
                                                        onclick="deleteTag({{ $purchase->id }})">
                                                    <i class="fa fa-times m-0"></i>
                                                </button>
                                                <form id="delete-form-{{ $purchase->id }}"
                                                      action="{{ route('purchase.destroy', $purchase->id) }}"
                                                      method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
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
