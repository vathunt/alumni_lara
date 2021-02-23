{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))

--}}

@extends('errors::illustrated-layout')

@section('code', '404 😕')

@section('title', __('Page Not Found'))

@section('image')

<div style="background-image: url('./images/OHD_Page-404.gif');" class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
</div>

@endsection

@section('message', __('Maaf, Halaman Tidak Ditemukan.'))