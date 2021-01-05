@extends('layouts.app')

@section('content')
<div class="container pt-3">
  <h1>Your Cart</h1>
  @if(count($carts) == 0)
    <p class="mt-3">Your cart is empty</p>
  @endif
  <div class="d-flex flex-column">
    @for($i = 0; $i < count($carts); $i++)
    <div class="d-flex py-3 px-5 card bg-secondary flex-row mt-3">
      <div style="width: 200px">
        <img class="responsive-img" src="{{ asset($carts[$i]->product->image) }}">
      </div>
      <div style="flex: 1" class="d-flex flex-column justify-content-center pl-5">
        <div>
          <p class="font-weight-bold mb-1">{{ $carts[$i]->product->name }}</p>
          <p class="text-fade text-sm mb-0">@ {{ rupiah($carts[$i]->product->price) }}</p>
        </div>
      </div>
      <form action="{{ route('update-cart') }}" method="POST" style="flex: 1" class="d-flex justify-content-center align-items-center">
        @csrf
        <div class="d-flex position-relative align-items-center">
          <input type="hidden" value="{{ $carts[$i]->id }}" name="cart_id">
          <i class="fa fa-angle-down fa-2x mr-3 arrow-qty pointer" data-product="{{ $carts[$i]->product->id }}"></i>
          <input min="0" class="form-control bg-dark qty" type="number" name="qty" id="qty-{{ $carts[$i]->product->id }}" value="{{ $carts[$i]->quantity }}" style="width: 8ch" data-qty="{{ $carts[$i]->quantity }}" data-product="{{ $carts[$i]->product->id }}" data-price="{{ $carts[$i]->product->price }}">
          <i class="fa fa-angle-up fa-2x ml-3 arrow-qty pointer" data-product="{{ $carts[$i]->product->id }}"></i>
          <div class="d-flex align-items-center justify-content-center position-absolute hide" style="bottom: -20px; transform: translateY(100%)" id="buttons-{{ $carts[$i]->product->id }}">
            <button class="btn mr-2 text-light btn-outline-primary btn-" type="reset" onclick="document.getElementById('buttons-{{ $carts[$i]->product->id }}').classList.add('hide'); const a = document.getElementById('subtotal-{{ $carts[$i]->product->id }}'); a.textContent = a.dataset.subtotal">Cancel</button>
            <button class="btn btn-primary" type="submit" id="update-{{ $carts[$i]->product->id }}">Update</button>
            <button class="btn btn-danger hide" type="submit" id="remove-{{ $carts[$i]->product->id }}">Remove</button>
          </div>
        </div>
      </form>
      <div style="width: 200px" class="d-flex align-items-center justify-content-end">
        <p class="font-weight-bold h4 text-right subtotal" id="subtotal-{{ $carts[$i]->product->id }}" data-subtotal="{{ rupiah($subtotals[$i]) }}">{{ rupiah($subtotals[$i]) }}</p>
      </div>
    </div>
    @endfor
  </div>
  <div class="d-flex justify-content-end mt-5 flex-column align-items-end">
    <span class="text-fade mb-1">Grand Total:</span>
    <span class="font-weight-bold h4" id="grand-total">Rp.</span>
    
    @if(count($carts) > 0)
    <form method="POST" action="{{ route('checkout') }}">
      @csrf
      <button class="btn btn-primary mt-3">Checkout</button>
    </form>
    @endif
  </div>
</div>
@endsection
