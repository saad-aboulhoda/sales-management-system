@extends('layouts.master')

@section('title', 'إضافة مخزن | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> المخازن</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">المخازن</li>
                <li class="breadcrumb-item"><a href="#">الإضافة</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="">
            <a class="btn btn-primary" href="{{ route('store.index') }}"><i class="fa fa-edit"></i> إدارة المخازن</a>
        </div>
        <div class="row mt-2">

            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">استمارة الإضافة</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{ route('store.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">الإسم</label>
                                    <input name="name" class="form-control @error('name') is-invalid @enderror"
                                        type="text" placeholder="أدخل اسم المخزن">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">العنوان</label>
                                    <input name="adresse" class="form-control @error('adresse') is-invalid @enderror"
                                        type="text" placeholder="أدخل عنوان المخزن">
                                    @error('adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">ملاحظات</label>
                                    <textarea rows="6" name="notes" class="form-control @error('notes') is-invalid @enderror" type="text"
                                        placeholder="ملاحظات..." style="resize: none">
                                    </textarea>
                                    @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-plus"></i>إضافة
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
