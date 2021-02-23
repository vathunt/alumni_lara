@extends('errors::illustrated-layout')

@section('code', '500 😑')

@section('title', __('Internal Server Error'))

@section('image')

<div style="background-image: url('./images/76289acbe6c5a83ccf648702b7e8d3b9.gif');" class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
</div>

@endsection

@section('message', __('Maaf, Sepertinya Ada yang Salah.'))