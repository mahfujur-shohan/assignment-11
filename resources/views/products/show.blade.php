@extends('layouts.app')

@section('title', 'View Product')

@section('breadcump-title', 'View Product')

@section('content')
<div class="container">
    <h1>Product Details</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>Name:</strong> {{ $product->name }}</p>
            <p class="card-text"><strong>Category:</strong> {{ $product->category }}</p>
            <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p class="card-text"><strong>Short Description:</strong> {{ $product->short_description }}</p>
            <p class="card-text"><strong>Long Description:</strong> {{ $product->long_description }}</p>
            <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($product->status) }}</p>
            <p class="card-text"><strong>SEO Tags:</strong> {{ $product->seo_tags }}</p>
            @if($product->image)
                <p class="card-text">
                    <strong>Image:</strong><br>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="200">
                </p>
            @endif
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection