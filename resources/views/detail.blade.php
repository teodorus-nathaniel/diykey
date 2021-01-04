@extends('layouts.app')

@section('content')
<div class="container pt-5">
  <div class="row">
    <div class="col-5">
      <img class="responsive-img" src="{{ asset('images/sakura-keycaps.png') }}" alt="">
    </div>
    <div class="col-7 d-flex flex-column">
      <div class="mb-2">
        @if($qty > 0)
          <div class="chip bg-secondary py-1 px-3 d-inline-block">{{ $qty }} in cart</div>
        @endif
      </div>
      <h1 class="font-weight-bold mb-0">{{ $product->name }}</h1>
      <p class="text-sm font-weight-bold text-fade mb-5">{{ $product->category->name }}</p>
      <p class="mb-5">{{ $product->description }}</p>
      @guest
      <a href="{{ route('login') }}"><button class="btn btn-primary">Sign in to buy items</button></a>
      @else
      <form class="d-flex" method="POST" action="{{ route('add-cart') }}">
        @csrf
        <input type="hidden" value="{{ $product->id }}" name="product">
        <div class="form-floating mb-0">
          <input style="width: 10ch" value="{{ $qty }}" type="number" name="qty" class="form-control bg-dark @error('qty') is-invalid @enderror">
        </div>
        <button type="submit" class="ml-3 btn btn-primary">
          {{ $qty == 0 ? 'Add to cart' : 'Update cart' }}
        </button>
      </form>
      @error('qty')
        <span class="invalid-feedback" style="display: block" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
      @endif
    </div>
  </div>
</div>
@endsection
