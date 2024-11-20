@extends('layouts.master')

@section('titel', 'الزبائن | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> إدارة الزبائن</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">الزبائن</li>
                <li class="breadcrumb-item active"><a href="#">الإدارة</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @can('customer-create')
            <div>
                <a class="btn btn-primary" href="{{ route('customer.create') }}"><i class="fa fa-plus"></i> إضافة زبون
                    جديد</a>
            </div>
        @endcan

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>الزبون</th>
                                <th>العنوان</th>
                                <th>الهاتف</th>
                                <th>ملاحظات</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }} </td>
                                    <td>{{ $customer->address }} </td>
                                    <td>{{ $customer->mobile }} </td>
                                    <td>{{ $customer->notes }} </td>
                                    <td>
                                        @can('customer-edit')
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ route('customer.edit', $customer->id) }}"><i
                                                    class="fa fa-edit m-0"></i></a>
                                        @endcan
                                        @can('customer-delete')
                                            <button class="btn btn-danger btn-sm waves-effect" type="submit"
                                                    onclick="deleteTag({{ $customer->id }})">
                                                <i class="fa fa-trash m-0"></i>
                                            </button>
                                            <form id="delete-form-{{ $customer->id }}"
                                                  action="{{ route('customer.destroy', $customer->id) }}" method="POST"
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
