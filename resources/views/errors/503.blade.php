@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code', '503 🛠️')

@section('image')

<div style="background-image: url('./images/503.gif');" class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
</div>

@endsection

@section('message', __($exception->getMessage() ?: 'Maaf, Server Sedang Ada Perbaikan'))
