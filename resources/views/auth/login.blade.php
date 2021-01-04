@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100 d-flex position-relative pb-5 align-items-center justify-content-center min-height-content">
        <form class="card bg-secondary p-5" style="width: 550px" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="pb-4">
                <h1 class="text-center h2 font-weight-bold">Welcome Back</h1>
                <p class="text-center text-sm">Customize your keyboard to have better typing experience!</p>
            </div>
            <div class="pb-5">
                <div class="form-floating mb-4">
                    <label for="email" class="font-weight-bold">Email</label>
                    <input type="email" name="email" class="form-control bg-dark @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input type="password" name="password" class="form-control bg-dark @error('password') is-invalid @enderror" id="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p class="text-center mt-3">Don't have an account yet? <a class="font-weight-bold text-link" href="{{ route('register') }}">Register</a> here!</p>
        </form>
    </div>
</div>
@endsection
