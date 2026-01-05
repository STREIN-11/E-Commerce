@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo">A</div>
        <div class="brand-text">
            <div class="brand-name">AdminHub</div>
            <div class="brand-tagline">Edit Product</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">🏠 Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="nav-link">📦 Products</a>
            <a href="{{ route('admin.products.show', $product) }}" class="nav-link">👁 View</a>
        </div>
    </div>
    <div class="nav-right">
        <div class="user-menu">
            <div class="user-avatar">{{ substr(auth('admin')->user()->name, 0, 1) }}</div>
            <div class="user-info">
                <div class="user-name">{{ auth('admin')->user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</nav>

<h1>Edit Product</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
    </div>
    
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
    </div>
    
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
    </div>
    
    <div class="form-group">
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="{{ old('category', $product->category) }}" required>
    </div>
    
    <div class="form-group">
        <label for="stock">Stock Quantity:</label>
        <input type="number" id="stock" name="stock" min="0" value="{{ old('stock', $product->stock) }}" required>
    </div>
    
    <div class="form-group">
        <label for="image">Product Image (optional):</label>
        <input type="file" id="image" name="image" accept="image/*">
        <small>Current image: {{ $product->image }}</small>
    </div>
    
    <button type="submit" class="btn">Update Product</button>
    <a href="{{ route('admin.products.show', $product) }}" class="btn" style="background: #6c757d;">Cancel</a>
</form>
@endsection