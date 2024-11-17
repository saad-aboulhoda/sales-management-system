@extends('layouts.master')

@section('title', 'الملف الشخصي | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> تعديل الملف الشخصي</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">الملف الشخصي</li>
                <li class="breadcrumb-item"><a href="#"> تعديل</a></li>
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
                    <div>
                        <div>
                            @if(Auth::user()->image)
                            <img width="60 px" class="app-sidebar__user-avatar"
                                src="{{ asset('images/user/' . Auth::user()->image) }}" alt="User Image">
                            @endif
                            <p><span class="badge badge-dark">{{ Auth::user()->fullname }}</span></p>
                        </div>
                    </div>
                    <form action="{{ route('update_profile', Auth::user()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <h4>المعلومات الشخصية</h4>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="Inputfname">الاسم</label>
                                <input value="{{ Auth::user()->f_name }}" name="f_name" class="form-control" id="Inputfname"
                                       type="text" aria-describedby="emailHelp" placeholder="أدخل الاسم"><small
                                    class="form-text text-muted" id="emailHelp"></small>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="Inputlname">النسب</label>
                                <input value="{{ Auth::user()->l_name }}" name="l_name" class="form-control" id="Inputlname"
                                       type="text" aria-describedby="emailHelp" placeholder="أدخل النسب"><small
                                    class="form-text text-muted" id="emailHelp"></small>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="InputEmail1">البريد الالكتروني</label>
                                <input value="{{ Auth::user()->email }}" name="email" class="form-control" id="InputEmail1"
                                       type="email" aria-describedby="emailHelp" placeholder="أدخل البريد الالكتروني"><small
                                    class="form-text text-muted" id="emailHelp"></small>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="InputMobile">رقم الهاتف</label>
                                <input value="{{ Auth::user()->mobile }}" name="mobile" class="form-control" id="InputMobile"
                                       type="text" aria-describedby="emailHelp" placeholder="أدخل رقم الهاتف"><small
                                    class="form-text text-muted" id="emailHelp"></small>
                            </div>
                        </div>

                        <!-- Password change section -->
                        <hr>
                        <h4>تغيير كلمة المرور</h4>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="InputPassword">كلمة المرور الحالية</label>
                                <input name="current_password" class="form-control" id="InputPassword" type="password"
                                       placeholder="أدخل كلمة المرور الحالية">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="InputNewPassword">كلمة المرور الجديدة</label>
                                <input name="new_password" class="form-control" id="InputNewPassword" type="password"
                                       placeholder="أدخل كلمة مرور جديدة">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="InputConfirmPassword">تأكيد كلمة المرور الجديدة</label>
                                <input name="confirm_password" class="form-control" id="InputConfirmPassword" type="password"
                                       placeholder="تأكيد كلمة المرور الجديدة">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>الصورة</label>
                            <input class="form-control" name="image" type="file">
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
