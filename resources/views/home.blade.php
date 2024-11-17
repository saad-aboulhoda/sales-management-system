@extends('layouts.master')

@section('title', 'الصفحة الرئيسية | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    @include('partials.content')

@endsection
