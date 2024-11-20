@extends('layouts.master')

@section('titel', 'المستخدمين | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> إدارة المستخدمين</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">المستخدمين</li>
                <li class="breadcrumb-item active"><a href="#">الإدارة</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @can('user-create')
            <div>
                <a class="btn btn-primary" href="{{ route('user.create') }}"><i class="fa fa-plus"></i> إضافة مستخدم
                    جديد</a>
            </div>
        @endcan

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>النسب</th>
                                <th>رقم الهاتف</th>
                                <th>الوظيفة</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->f_name }} </td>
                                    <td>{{ $user->l_name }} </td>
                                    <td>{{ $user->mobile }} </td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $role)
                                                <label class="badge badge-success">{{ __($role) }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @can('user-edit')
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ route('user.edit', $user->id) }}"><i
                                                    class="fa fa-edit m-0"></i></a>
                                        @endcan
                                        @can('user-delete')
                                            <button class="btn btn-danger btn-sm waves-effect" type="submit"
                                                    onclick="deleteTag({{ $user->id }})">
                                                <i class="fa fa-trash m-0"></i>
                                            </button>
                                            <form id="delete-form-{{ $user->id }}"
                                                  action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
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

