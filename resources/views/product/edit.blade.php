@extends('layouts.master')

@section('title', 'تعديل منتج | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>تعديل منتج</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">المنتجات</li>
                <li class="breadcrumb-item"><a href="#">التعديل</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div>
            <a class="btn btn-primary" href="{{route('product.index')}}"><i class="fa fa-edit"></i> إدارة المنتجات</a>
        </div>
        <div class="row mt-2">

            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">استمارة التعديل</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{route('product.update', $product->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">الاسم</label>
                                    <input name="name" value="{{ $product->name  }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           type="text" placeholder="أدخل اسم المنتج">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">موديل</label>
                                    <input name="model" value="{{ $product->model  }}"
                                           class="form-control @error('model') is-invalid @enderror"
                                           type="text" placeholder="أدخل الموديل">
                                    @error('model')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">التصنيف</label>

                                    <select name="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">اختر التصنيف</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">ثمن العلبة</label>
                                    <input name="box_price"
                                           value="{{ $product->box_price }}"
                                           class="form-control @error('box_price') is-invalid @enderror"
                                           type="number" placeholder="أدخل ثمن العلبة">
                                    @error('box_price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">عدد العلب</label>
                                    <input name="box_qty" value="{{ $product->box_qty  }}"
                                           class="form-control @error('box_qty') is-invalid @enderror"
                                           type="number" placeholder="أدخل عدد العلب">
                                    @error('box_qty')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">عدد المنتجات في العلبة</label>
                                    <input name="qty" value="{{ $product->qty  }}"
                                           class="form-control @error('qty') is-invalid @enderror"
                                           type="number" placeholder="أدخل عدد المنتجات في العلبة">
                                    @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">المخزن</label>
                                    <select name="store_id"
                                            class="form-control @error('store_id') is-invalid @enderror">
                                        <option value="">اختر المخزن</option>
                                        @foreach ($stores as $store)
                                            <option value="{{ $store->id }}"
                                                    @if($store->id == $product->store_id) selected @endif>{{ $store->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('store_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">صورة المنتج</label>
                                    <input name="image" class="form-control @error('image') is-invalid @enderror"
                                           type="file">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i>تعديل
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
