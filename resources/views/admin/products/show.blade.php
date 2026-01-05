@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo">A</div>
        <div class="brand-text">
            <div class="brand-name">AdminHub</div>
            <div class="brand-tagline">Product Details</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">🏠 Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="nav-link">📦 Products</a>
            <a href="{{ route('admin.products.edit', $product) }}" class="nav-link">✏️ Edit</a>
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

<h1>Product Details</h1>

<div style="background: #f8f9fa; padding: 20px; border-radius: 8px;">
    <h2>{{ $product->name }}</h2>
    
    <div style="margin: 15px 0;">
        <strong>Description:</strong>
        <p>{{ $product->description }}</p>
    </div>
    
    <div style="margin: 15px 0;">
        <strong>Price:</strong> ${{ number_format($product->price, 2) }}
    </div>
    
    <div style="margin: 15px 0;">
        <strong>Category:</strong> {{ $product->category }}
    </div>
    
    <div style="margin: 15px 0;">
        <strong>Stock:</strong> {{ $product->stock }} units
    </div>
    
    <div style="margin: 15px 0;">
        <strong>Image:</strong> 
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="max-width: 200px; height: auto; border-radius: 8px; margin-top: 10px;">
    </div>
    
    <div style="margin: 15px 0;">
        <strong>Created:</strong> {{ $product->created_at->format('M d, Y H:i') }}
    </div>
    
    <div style="margin: 15px 0;">
        <strong>Updated:</strong> {{ $product->updated_at->format('M d, Y H:i') }}
    </div>
</div>

<div style="margin-top: 20px;">
    <a href="{{ route('admin.products.edit', $product) }}" class="btn">Edit Product</a>
    <a href="{{ route('admin.products.index') }}" class="btn" style="background: #6c757d;">Back to Products</a>
    
    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete Product</button>
    </form>
</div>
@endsection