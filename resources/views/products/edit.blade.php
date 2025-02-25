@extends('layouts.app')

@section('title', 'Edit Product')

@section('breadcump-title', 'Edit Product')

@push('styles')

<style>

</style>

@endpush

@section('content')

<div class="container">
    <h1 class="my-4">Edit Product</h1>

    <!-- Edit Product Form -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $product->category) }}" required>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" required>
        </div>

        <!-- Short Description -->
        <div class="mb-3">
            <label for="short_description" class="form-label">Short Description</label>
            <textarea class="form-control" id="short_description" name="short_description" rows="3" required>{{ old('short_description', $product->short_description) }}</textarea>
        </div>

        <!-- Long Description -->
        <div class="mb-3">
            <label for="long_description" class="form-label">Long Description</label>
            <textarea class="form-control" id="long_description" name="long_description" rows="5" required>{{ old('long_description', $product->long_description) }}</textarea>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($product->image)
                <div class="mt-2">
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="100">
                </div>
            @endif
        </div>

        <!-- Stock -->
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- SEO Tags -->
        <div class="mb-3">
            <label for="seo_tags" class="form-label">SEO Tags</label>
            <textarea class="form-control" id="seo_tags" name="seo_tags" rows="3">{{ old('seo_tags', $product->seo_tags) }}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection

@push('scripts')

<script>
    
</script>

@endpush
