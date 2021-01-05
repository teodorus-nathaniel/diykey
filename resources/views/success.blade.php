@extends('layouts.app')

@section('content')
<div class="container pt-5 position-relative">
    <div>
        <h1>Transaction Success</h1>
        <p>Thank you for your purchase!</p>
        <a href="{{ route('home') }}"><button class="btn btn-primary mt-4">Back to Home</button></a>
    </div>
    <div class="no-pointer translate-left position-absolute z-0 font-weight-bold" style="top: 0px; right: 0; transform: translate(-40%, -15%); font-size: 125px; color: rgba(255, 255, 255, .01)">
        SUCCESS
    </div>
</div>
@endsection
