@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo customer-logo">S</div>
        <div class="brand-text">
            <div class="brand-name">ShopHub</div>
            <div class="brand-tagline">Customer Portal</div>
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

<h1>Customer Dashboard</h1>

<p>Welcome to your customer dashboard. You are now logged in as a customer.</p>

<div style="margin-top: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3>Available Products</h3>
        <div class="search-container" style="display: flex; align-items: center; gap: 0.5rem;">
            <span class="search-icon" style="position: static; transform: none; color: #48bb78;">🔍</span>
            <form method="GET" action="{{ route('customer.dashboard') }}" style="display: inline; width: 100%;" id="searchForm">
                <input type="text" name="search" placeholder="Search products..." style="background: #f0fff4; border: 2px solid #48bb78; color: #22543d; padding: 0.5rem; border-radius: 8px; width: 250px; font-size: 0.875rem;" value="{{ request('search') }}" id="searchInput">
            </form>
        </div>
    </div>
    @if($products->count() > 0)
        <div class="product-grid">
            @foreach($products as $product)
            <div class="product-card" onclick="window.location.href='{{ route('customer.product.show', $product) }}'" style="cursor: pointer;">
                @if($product->image !== 'default-product.jpg')
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                @endif
                <div class="product-card-body">
                    <h4>{{ $product->name }}</h4>
                    <p><strong>Category:</strong> {{ $product->category }}</p>
                    <p class="price">${{ number_format($product->price, 2) }}</p>
                    <p><strong>Stock:</strong> {{ $product->stock }} units</p>
                    <p style="color: #4a5568;">{{ Str::limit($product->description, 100) }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <div style="margin-top: 20px;">
            {{ $products->links('pagination.custom') }}
        </div>
    @else
        <p>No products available. Admin needs to add products first.</p>
        <p><em>Tip: Login as admin to add products or import the sample CSV file.</em></p>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-search functionality
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const currentValue = this.value;
            const cursorPosition = this.selectionStart;
            
            searchTimeout = setTimeout(function() {
                // Store cursor position before form submission
                sessionStorage.setItem('searchCursor', cursorPosition);
                sessionStorage.setItem('searchValue', currentValue);
                searchForm.submit();
            }, 500);
        });
        
        // Restore cursor position after page load
        const savedCursor = sessionStorage.getItem('searchCursor');
        const savedValue = sessionStorage.getItem('searchValue');
        if (savedCursor && savedValue === searchInput.value) {
            searchInput.focus();
            searchInput.setSelectionRange(savedCursor, savedCursor);
            sessionStorage.removeItem('searchCursor');
            sessionStorage.removeItem('searchValue');
        }
    }
    
    // Initialize Echo for customer presence
    if (window.Echo) {
        window.Echo.join('presence.customer')
            .here((users) => {
                console.log('Current customers online:', users);
            })
            .joining((user) => {
                console.log('Customer joining:', user);
            })
            .leaving((user) => {
                console.log('Customer leaving:', user);
            });
    }
});

// Product details modal
function showProductDetails(id, name, category, price, stock, description) {
    alert(`Product: ${name}\nCategory: ${category}\nPrice: $${price}\nStock: ${stock} units\nDescription: ${description}`);
}
</script>
@endsection