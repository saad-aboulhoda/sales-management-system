@extends('layouts.master')

@section('title', 'تعديل معلومات مورد | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> تعديل معلومات مورد</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">الموردين</li>
                <li class="breadcrumb-item"><a href="#">التعديل</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="row">
            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">استمارة التعديل</h3>
                    <div class="tile-body">
                        <form class="row" method="POST" action="{{route('supplier.update', $supplier->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-12">
                                <label class="control-label">الاسم</label>
                                <input value="{{ $supplier->name }}" name="name"
                                       class="form-control @error('name') is-invalid @enderror" type="text"
                                       placeholder="أدخل اسم المورد">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">الهاتف</label>
                                <input value="{{ $supplier->mobile }}" name="mobile"
                                       class="form-control @error('mobile') is-invalid @enderror" type="text"
                                       placeholder="أدخل رقم هاتف المورد">
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">العنوان</label>
                                <textarea name="address"
                                          class="form-control @error('address') is-invalid @enderror">{{ $supplier->address }}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">ملاحظات</label>
                                <textarea name="notes"
                                          class="form-control @error('notes') is-invalid @enderror">{{ $supplier->notes }}</textarea>
                                @error('notes')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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



