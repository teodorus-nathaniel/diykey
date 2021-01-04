@extends('layouts.app')

@section('content')
<div class="w-100 bg-secondary sticky-top">
    <div class="container d-flex justify-content-between py-3">
        <form class="d-flex">
            <input type="hidden" value="" id="category" name="category">
            <button type="submit" onclick="document.getElementById('category').value = ''" class="py-2 px-4 {{ $selected_category == '' ? 'bg-primary' : 'bg-dark' }} border-0 text-light chip mr-3">All Products</button>
            @foreach($categories as $category)
            <button type="submit" onclick="document.getElementById('category').value = '{{ $category->name }}'" class="py-2 px-4 {{ $selected_category == $category->name ? 'bg-primary' : 'bg-dark' }} border-0 text-light chip mr-3">{{ $category->name }}</button>
            @endforeach
        </form>
        <form class="d-flex align-items-center">
            <input type="text" class="form-control bg-dark" name="q" value="{{ $search }}" placeholder="Search...">
            <button type="submit" style="border: none; background: transparent; color: #DEDEDE">
                <i class="fa fa-search ml-2 fa-lg"></i>
            </button>
        </form>
    </div>
</div>
<div class="container pt-5 position-relative z-children-1">
    @if(count($products) == 0)
    <h1>No Products Found</h1>
    @endif
    <div class="grid-container">
        @for($i = 0; $i < count($products); $i++)
        <div class="card bg-secondary product py-5 px-4" onclick="const a = document.getElementById(`link-{{ $products[$i]->id }}`); if(a) a.click()">
            <a href="{{ route('product', [ 'product' => $products[$i]->id ]) }}" id="link-{{ $products[$i]->id }}"></a>
            <img class="responsive-img" src="{{ asset('images/sakura-keycaps.png') }}">
            <p class="text-sm font-weight-bold text-fade mb-1">{{ $products[$i]->category->name }}</p>
            <p class="font-weight-bold mb-4 dense-line-height">{{ $products[$i]->name }}</p>
            <p class="font-weight-bold text-link h2">{{ rupiah($products[$i]->price) }}</p>
            @if(isset($favourited[$i]) && $favourited[$i])
            <i class="fa fa-heart fa-2x"></i>
            @else
            <i class="fa fa-heart-o fa-2x"></i>
            @endif

            @if($in_cart[$i] > 0)
            <div class="chip bg-dark py-1 px-3">{{$in_cart[$i]}} in cart</div>
            @endif
        </div>
        @endfor
    </div>
    <div class="no-pointer translate-left position-absolute z-0 font-weight-bold" style="top: 0px; left: 0; transform: translate(-30%, -15%); font-size: 125px; color: rgba(255, 255, 255, .05)">
        ALL PRODUCTS
    </div>
</div>
@endsection
