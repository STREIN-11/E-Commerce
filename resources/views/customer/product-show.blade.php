@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo customer-logo">S</div>
        <div class="brand-text">
            <div class="brand-name">ShopHub</div>
            <div class="brand-tagline">Product Details</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="{{ route('customer.dashboard') }}" class="nav-link">📦 Products</a>
        </div>
    </div>
    <div class="nav-right">
        <div class="user-menu">
            <div class="user-avatar customer-avatar">{{ substr(auth('customer')->user()->name, 0, 1) }}</div>
            <div class="user-info">
                <div class="user-name">{{ auth('customer')->user()->name }}</div>
                <div class="user-role">Customer</div>
            </div>
        </div>
        <form method="POST" action="{{ route('customer.logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</nav>

<div class="card" style="max-width: 800px; margin: 2rem auto;">
    <div class="card-body">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: start;">
            <div>
                @if($product->image !== 'default-product.jpg')
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; border-radius: 8px;">
                @else
                    <div style="width: 100%; height: 300px; background: #f7fafc; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #a0aec0;">
                        No Image Available
                    </div>
                @endif
            </div>
            
            <div>
                <h1 style="margin-bottom: 1rem;">{{ $product->name }}</h1>
                
                <div style="margin-bottom: 1rem;">
                    <span style="background: #667eea; color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem;">
                        {{ $product->category }}
                    </span>
                </div>
                
                <div style="font-size: 2rem; font-weight: 700; color: #38a169; margin-bottom: 1rem;">
                    ${{ number_format($product->price, 2) }}
                </div>
                
                <div style="margin-bottom: 1rem;">
                    <strong>Stock:</strong> {{ $product->stock }} units available
                </div>
                
                <div style="margin-bottom: 2rem;">
                    <h3 style="margin-bottom: 0.5rem;">Description</h3>
                    <p style="color: #4a5568; line-height: 1.6;">{{ $product->description }}</p>
                </div>
                
                <div style="display: flex; gap: 1rem;">
                    <button class="btn" style="flex: 1;">Add to Cart</button>
                    <button class="btn" style="background: #38a169;">Buy Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection