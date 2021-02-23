@extends('errors::illustrated-layout')

@section('title', __('Page Expired'))
@section('code', '419 😑')

@section('image')

<div style="background-image: url('./images/419.gif');" class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
</div>

@endsection

@section('message', __('Sesi Anda Telah Berakhir'))
