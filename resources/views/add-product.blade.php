@extends('layouts.app')

@section('content')
<div class="container mt-4 z-children-1 position-relative">
  <div class="d-flex align-items-start position-relative">
    <form method="POST" action="{{ route('add') }}" style="flex: 1" class="bg-secondary card px-5 py-4" enctype="multipart/form-data">
      @csrf
      <h1 class="mb-4 mt-2 h3 font-weight-bold">New Product Informations</h1>
      <div class="mt-1">
        <div class="mb-4">
          <label for="name" class="font-weight-bold">Name</label>
          <input type="text" name="name" class="data-listen form-control bg-dark @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name">
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="mb-4">
          <label for="description" class="font-weight-bold">Description</label>
          <input type="text" name="description" class="data-listen form-control bg-dark @error('description') is-invalid @enderror" value="{{ old('description') }}" id="description">
          @error('description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="mb-4">
          <label for="price" class="font-weight-bold">Price</label>
          <input type="number" name="price" class="data-listen form-control bg-dark @error('price') is-invalid @enderror" value="{{ old('price') }}" id="price">
          @error('price')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="mb-4">
          <label for="category" class="font-weight-bold">Category</label>
          <select name="category" class="data-listen form-control text-light bg-dark @error('price') is-invalid @enderror" value="{{ old('category') }}" id="category">
            <option default hidden value="">-- Select Category --</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" style="text-transform: capitalize">{{ $category->name }}</option>
            @endforeach
          </select>
          @error('category')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="mb-4">
          <label for="category" class="font-weight-bold">Image</label>
          <input type="file" name="image" class="data-listen form-control-file bg-dark @error('image') is-invalid @enderror" value="{{ old('image') }}" id="image">
          @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <button class="btn btn-primary mb-4 mt-5">Add Product</button>
      </div>
    </form>
    <div class="d-flex flex-column ml-5">
      <p class="font-weight-bold">Preview:</p>
      <div class="card bg-secondary product pointer" style="width: 225px; overflow:hidden">
        <img id="preview-image" class="responsive-img mb-3" src="{{ asset('images/placeholder.png') }}">
        <p class="text-sm font-weight-bold text-fade mb-1 px-4" id="preview-category">Category</p>
        <p class="font-weight-bold mb-4 dense-line-height px-4" id="preview-name">Name</p>
        <p class="font-weight-bold text-link h4 mt-auto px-4 pb-4" id="preview-price">Price</p>
      </div>
    </div>
  </div>
  
  <div class="no-pointer translate-left position-absolute z-0 font-weight-bold" style="top: 0px; left: 0; transform: translate(80%, 50%); font-size: 125px; color: rgba(255, 255, 255, .02)">
      Transactions
  </div>
</div>
@endsection
