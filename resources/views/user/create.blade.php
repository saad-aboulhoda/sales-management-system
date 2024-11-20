@extends('layouts.master')

@section('title', 'إضافة مستخدم | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> إضافة مستخدم</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">المستخدمين</li>
                <li class="breadcrumb-item"><a href="#">الإضافة</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <div class="tile">
                <div class="col-lg-12">
                    <form action="{{ route('user.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <h4>المعلومات الشخصية</h4>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="Inputfname">الاسم</label>
                                <input value="{{ old('f_name') }}" name="f_name" class="form-control @error('f_name') is-invalid @enderror" id="Inputfname"
                                       type="text" placeholder="أدخل الاسم">
                                @error('f_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="Inputlname">النسب</label>
                                <input value="{{ old('l_name') }}" name="l_name" class="form-control @error('l_name') is-invalid @enderror" id="Inputlname"
                                       type="text" placeholder="أدخل النسب">
                                @error('l_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="InputEmail1">البريد الالكتروني</label>
                                <input value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail1"
                                       type="email" placeholder="أدخل البريد الالكتروني">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="InputMobile">رقم الهاتف</label>
                                <input value="{{ old('mobile') }}" name="mobile" class="form-control @error('mobile') is-invalid @enderror" id="InputMobile"
                                       type="text" placeholder="أدخل رقم الهاتف">
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password change section -->
                        <hr>
                        <h4>تغيير كلمة المرور</h4>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="InputNewPassword">كلمة المرور الجديدة</label>
                                <input name="password" class="form-control @error('password') is-invalid @enderror" id="InputNewPassword" type="password"
                                       placeholder="أدخل كلمة مرور جديدة">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="InputConfirmPassword">تأكيد كلمة المرور الجديدة</label>
                                <input name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="InputConfirmPassword" type="password"
                                       placeholder="تأكيد كلمة المرور الجديدة">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="InputRoles">الوظائف</label>
                            <select id="InputRoles" style="width: 100%" class="form-control multiple @error('roles') is-invalid @enderror" multiple="multiple" name="roles[]">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ __($role) }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>الصورة</label>
                            <input class="form-control @error('image') is-invalid @enderror" name="image" type="file">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">إضافة</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.multiple').select2({
                dir: 'rtl',
                tags: true
            });
        });
    </script>
@endpush
