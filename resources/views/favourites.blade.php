@extends('layouts.app')

@section('content')
<div class="container pt-5 position-relative z-children-1">
    @if(count($favouriteItems) == 0)
    <h1>No Favourited Product yet</h1>
    @endif
    <div class="grid-container">
        @csrf
        @for($i = 0; $i < count($favouriteItems); $i++)
        <div class="card bg-secondary product" style="overflow:hidden" data-product="{{ $favouriteItems[$i]->product->id }}">
            <a href="{{ route('product', [ 'product' => $favouriteItems[$i]->product->id ]) }}" id="link-{{ $favouriteItems[$i]->product->id }}"></a>
            <img class="responsive-img mb-3" src="{{ asset($favouriteItems[$i]->product->image) }}">
            <p class="text-sm font-weight-bold text-fade mb-1 px-4">{{ $favouriteItems[$i]->product->category->name }}</p>
            <p class="font-weight-bold mb-4 dense-line-height px-4">{{ $favouriteItems[$i]->product->name }}</p>
            <p class="font-weight-bold text-link h4 px-4 pb-4">{{ rupiah($favouriteItems[$i]->product->price) }}</p>
            @if(isset($favourited[$i]) && $favourited[$i])
            <div class="heart pointer" data-product="{{ $favouriteItems[$i]->product->id }}">
                <i class="fa fa-heart fa-2x"></i>
            </div>
            @else
            <div class="heart pointer" data-product="{{ $favouriteItems[$i]->product->id }}">
                <i class="fa fa-heart-o fa-2x"></i>
            </div>
            @endif

            @if($in_cart[$i] > 0)
            <div class="chip bg-dark py-1 px-3">{{$in_cart[$i]}} in cart</div>
            @endif
        </div>
        @endfor
    </div>
    <div class="no-pointer translate-left position-absolute z-0 font-weight-bold" style="top: 0px; left: 0; transform: translate(-30%, -15%); font-size: 125px; color: rgba(255, 255, 255, .05)">
        Favourites
    </div>
</div>
@endsection
