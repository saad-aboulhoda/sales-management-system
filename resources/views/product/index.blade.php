@extends('layouts.master')

@section('title', 'المنتوجات | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> إدارة المنتوجات</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">المنتوجات</li>
                <li class="breadcrumb-item active"><a href="#">الإدارة</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @can('product-create')
            <div>
                <a class="btn btn-primary" href="{{ route('product.create') }}"><i class="fa fa-plus"></i> أضف منتج</a>
            </div>
        @endcan

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>المنتج</th>
                                <th>ثمن العلبة</th>
                                <th>عدد العلب</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                @if ($product)
                                    <tr>
                                        <td style="display: flex"><img
                                                style="width: 45px; height: 45px; object-fit: cover; border-radius: 6px;
                                                margin-inline-end: 6px;"
                                                src="{{ asset('images/product/' . $product->image) }}">
                                            <div>
                                                <h6 class="m-0">{{ $product->name }}</h6>
                                                <span
                                                    style="font-size: 15px; color: #535353;">{{ $product->model }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $product->box_price }} درهم</td>
                                        <td>{{ $product->box_qty }} علبة</td>

                                        <td>
                                            @can('product-edit')
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{ route('product.edit', $product->id) }}"><i
                                                        class="fa fa-edit m-0"></i></a>
                                            @endcan
                                            @can('product-delete')
                                                <button class="btn btn-danger btn-sm waves-effect" type="submit"
                                                        onclick="deleteTag({{ $product->id }})">
                                                    <i class="fa fa-trash m-0"></i>
                                                </button>
                                                <form id="delete-form-{{ $product->id }}"
                                                      action="{{ route('product.destroy', $product->id) }}"
                                                      method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endif
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
