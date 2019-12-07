@extends('dashboard::layouts.main')

@section('custom_css')
    @include('media::header')
@endsection

@section('content')
    @include('media::content')
@endsection

@section('custom_js')
    @include('media::footer')
@endsection