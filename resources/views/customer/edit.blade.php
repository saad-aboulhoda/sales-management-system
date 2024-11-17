@extends('layouts.master')

@section('title', 'تعديل زبون | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> تعديل زبون</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">الزبائن</li>
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
                        <form method="POST" action="{{route('customer.update', $customer->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label class="control-label">الإسم</label>
                                    <input name="name" value="{{ $customer->name  }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           type="text" placeholder="أدخل اسم الزبون">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="control-label">الهاتف</label>
                                    <input name="mobile" value="{{ $customer->mobile  }}"
                                           class="form-control @error('mobile') is-invalid @enderror"
                                           type="text" placeholder="أدخل رقم هاتف الزبون">
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="control-label">البريد الالكتروني</label>
                                    <input type="email" name="email" value="{{ $customer->email  }}"
                                           class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="control-label">العنوان</label>
                                    <textarea name="address"
                                              class="form-control @error('address') is-invalid @enderror"></textarea>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="control-label">ملاحظات</label>
                                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror">
                                        {{ $customer->notes  }}
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



