@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429 😲')

@section('image')

<div style="background-image: url('./images/429.gif');" class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
</div>

@endsection

@section('message', __('Terlalu Banyak Permintaan'))
