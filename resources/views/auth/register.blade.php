@extends('layouts.master')

@section('content')
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="register-content">
        <div class="register-container">
            <div class="logo">
                <h2>صفحة التسجيل</h2>
            </div>
            <div class="register-box">
                <form class="register-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <h3 class="register-head"><i class="fa fa-lg fa-fw fa-user"></i>التسجيل</h3>
                    <div class="form-group">
                        <label class="control-label">الإسم</label>
                        <input id="f_name" type="text" class="form-control @error('f_name') is-invalid @enderror"
                            name="f_name" value="{{ old('f_name') }}" required autocomplete="email" autofocus>
                        @error('f_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label">النسب</label>
                        <input id="l_name" type="text" class="form-control @error('l_name') is-invalid @enderror"
                            name="l_name" value="{{ old('l_name') }}" required autocomplete="email" autofocus>
                        @error('l_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label">رقم الهاتف</label>
                        <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                            name="mobile" value="{{ old('mobile') }}" required autocomplete="email" autofocus>
                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label">البريد الالكتروني</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label">كلمة السر</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group btn-container">
                        <button class="btn btn-primary btn-block" type="submit"><i
                                class="fa fa-sign-in fa-lg fa-fw"></i>التسجيل</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
