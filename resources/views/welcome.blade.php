@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100 d-flex position-relative pb-5 align-items-center justify-content-between min-height-content z-children-1">
        <div class="w-40">
            <h1 class="font-weight-bold text-light mb-3">DIYKey</h1>
            <p class="text-light mb-5 base-line-height">One stop marketplace for all your keyboard needs</p>
            <a href="{{ route('products') }}"><button class="btn btn-primary btn-lg">Shop Now!</button></a>
        </div>
        <div class="f-1">
            <img class="w-100" src="{{ asset('images/keyboard.png') }}" alt="keyboard" style="transform: rotate(-10deg)">
        </div>
        <div class="position-absolute z-0 no-pointer" style="top: 0; width:500px; left: 0; transform: translateX(-60%)">
            <img class="w-100" src="{{ asset('images/logo-logitech.svg') }}">
        </div>
        <div class="position-absolute z-0 no-pointer" style="top: 20%; width:450px; right: 0; transform: translateX(70%)">
            <img class="w-100" src="{{ asset('images/logo-razer.svg') }}">
        </div>
        <div class="position-absolute z-0 no-pointer" style="bottom: 30px; width:400px; left: 50%; transform: translateX(-60%)">
            <img class="w-100" src="{{ asset('images/logo-corsair.svg') }}">
        </div>
    </div>
</div>
@endsection
