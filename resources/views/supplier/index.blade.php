@extends('layouts.master')

@section('title', 'الموردين | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> إدارة الموردين</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">الموردين</li>
                <li class="breadcrumb-item active"><a href="#">الإدارة</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @can('supplier-create')
            <div>
                <a class="btn btn-primary" href="{{route('supplier.create')}}"><i class="fa fa-plus"></i> إضافة مورد</a>
            </div>
        @endcan

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>المورد</th>
                                <th>العنوان</th>
                                <th>رقم الهاتف</th>
                                <th>ملاحظات</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->name }} </td>
                                    <td>{{ $supplier->address }} </td>
                                    <td>{{ $supplier->mobile }} </td>
                                    <td>{{ $supplier->details }} </td>
                                    <td>
                                        @can('supplier-edit')
                                            <a class="btn btn-primary btn-sm"
                                               href="{{route('supplier.edit', $supplier->id)}}"><i
                                                    class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('supplier-delete')
                                            <button class="btn btn-danger btn-sm waves-effect" type="submit"
                                                    onclick="deleteTag({{ $supplier->id }})">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            <form id="delete-form-{{ $supplier->id }}"
                                                  action="{{ route('supplier.destroy',$supplier->id) }}" method="POST"
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
