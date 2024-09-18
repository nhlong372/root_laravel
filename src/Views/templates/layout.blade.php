@extends('master')
@section('contentmaster')
	@include('layout.seo')
    @include('layout.header')
    @includeWhen(!empty($slider), 'layout.slider')
    @includeWhen(\NINA\Core\Support\Str::isNotEmpty(BreadCrumbs::get()),'layout.breadcrumbs')
    @yield('content')
    @include('layout.footer')
    @include('layout.strucdata')
    <?php /*
    @include('layout.extensions')
    */ ?>
@endsection