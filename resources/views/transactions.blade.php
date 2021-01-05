@extends('layouts.app')

@section('content')
<div class="container pt-3">
  <h1>Your Transaction History</h1>
  @if(count($transactions) == 0)
    <p class="mt-3">You haven't bought any product from us yet.</p>
  @endif
  <div class="d-flex flex-column mt-4">
    @for($i = count($transactions) - 1; $i >= 0; $i--)
    <div class="d-flex flex-column bg-secondary px-4 py-3 mb-4 rounded">
      <p class="mb-1">{{ $transactions[$i]->transaction_date }}</p>
      <h3 class="font-weight-bold mb-4">{{ rupiah($totals[$i]) }}</h3>
      <div class="grid-container" >
        @foreach($transactions[$i]->details as $detail)
        <div class="card bg-dark product py-4 px-4">
          <img class="responsive-img" src="{{ asset($detail->product->image) }}">
          <p class="text-sm font-weight-bold text-fade mb-1">{{ $detail->product->category->name }}</p>
          <p class="font-weight-bold mb-4 dense-line-height">{{ $detail->product->name }}</p>
          <p class="font-weight-bold text-link h4 mb-3 mt-auto">{{ rupiah($detail->product->price) }}</p>
          
          <a href="{{ route('product', [ 'product' => $detail->product->id ]) }}" class="w-100 d-block">
            <button class="btn btn-outline-primary w-100">Reorder</button>
          </a>
        </div>
        @endforeach
      </div>
    </div>
    @endfor
  </div>
</div>
@endsection
