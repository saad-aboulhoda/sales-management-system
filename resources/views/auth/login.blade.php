@extends('layouts.master')

@section('content')
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="login-container">
            <div class="logo">
                <h2>صفحة الولوج إلى لوحة التحكم</h2>
            </div>
            <div class="login-box">
                <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>تسجيل الدخول</h3>
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
                        <button class="btn btn-primary btn-block mt-4" type="submit"><i
                                class="fa fa-sign-in fa-lg fa-fw"></i>التسجيل</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
