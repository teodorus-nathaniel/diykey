@extends('layouts.app')

@section('content')
<div class="w-100 d-flex position-relative pb-5 align-items-center justify-content-center min-height-content">
    <div class="card bg-secondary p-5" style="width: 550px">
        <div class="pb-3">
            <h1 class="text-center h2 font-weight-bold">Welcome to DIYKey</h1>
            <p class="text-center text-sm">We sell our products from trusted producer in best prices!</p>
        </div>
        <div class="pb-5">
            <div class="form-floating mb-4">
                <label for="email" class="font-weight-bold">Email</label>
                <input type="email" class="form-control bg-dark" id="email">
            </div>
            <div class="form-floating mb-4">
                <label for="password" class="font-weight-bold">Password</label>
                <input type="password" class="form-control bg-dark" id="password">
            </div>
            <div class="form-floating mb-4">
                <label for="confirm-password" class="font-weight-bold">Confirm Password</label>
                <input type="password" class="form-control bg-dark" id="confirm-password">
            </div>
        </div>
        <button class="btn btn-primary">Login</button>
        <p class="text-center mt-3">Already have an account? <a class="font-weight-bold text-link" href="{{ route('login') }}">Login</a> here!</p>
    </div>
</div>
@endsection
