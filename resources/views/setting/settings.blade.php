@extends('layouts.master')

@section('title', 'الإعدادات  | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> الإعدادات</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">الإعدادات</li>
                <li class="breadcrumb-item"><a href="#"> التعديل</a></li>
            </ul>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div>
            <div class="tile">
                <div class="col-lg-12">
                    <form action="{{ route('setting.save') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <h4>معلومات الشركة</h4>
                        <div class="row">
                            @foreach($settings as $setting)
                                <div class="form-group col-lg-6">
                                    <label for="{{ $setting->option_name  }}">{{ __($setting->option_name)  }}</label>
                                    <input value="{{ $setting->value  }}" name="f_name" class="form-control"
                                           id="{{ $setting->option_name }}"
                                           type="text">
                                </div>
                            @endforeach
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
    </main>

@endsection
