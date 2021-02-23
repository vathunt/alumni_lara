@extends('errors::illustrated-layout')

@section('title', __('Unauthorized'))
@section('code', '401 😡')

@section('image')

<div style="background-image: url('./images/unauthorized-animation.gif');" class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
</div>

@endsection

@section('message', __('Stop, Akses Anda Tidak Sah!'))
