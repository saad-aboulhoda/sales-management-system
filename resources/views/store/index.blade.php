@extends('layouts.master')

@section('titel', 'المخازن | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> إدرة المخازن</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">المخازن</li>
                <li class="breadcrumb-item active"><a href="#">إدارة المخازن</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @can('store-create')
            <div>
                <a class="btn btn-primary" href="{{ route('store.create') }}"><i class="fa fa-plus"></i> أضف مخزن</a>
            </div>
        @endcan

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>الإسم</th>
                                <th>العنوان</th>
                                <th>ملاحظات</th>
                                <th>الحالة</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($stores as $store)
                                <tr>
                                    <td>{{ $store->name }} </td>
                                    <td>{{ $store->adresse }} </td>
                                    <td>{{ $store->notes }} </td>
                                    @if ($store->status)
                                        <td>مفعل</td>
                                    @else
                                        <td>غير مفعل</td>
                                    @endif


                                    <td>
                                        @can('store-edit')
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ route('store.edit', $store->id) }}"><i
                                                    class="fa fa-edit m-0"></i></a>
                                        @endcan
                                        @can('store-delete')
                                            <button class="btn btn-danger btn-sm waves-effect" type="submit"
                                                    onclick="deleteTag({{ $store->id }})">
                                                <i class="fa fa-trash m-0"></i>
                                            </button>
                                            <form id="delete-form-{{ $store->id }}"
                                                  action="{{ route('store.destroy', $store->id) }}" method="POST"
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
