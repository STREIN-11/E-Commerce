@extends('layouts.app')

@section('title', 'Products Management')

@section('content')
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo">A</div>
        <div class="brand-text">
            <div class="brand-name">AdminHub</div>
            <div class="brand-tagline">Products</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">🏠 Dashboard</a>
            <a href="{{ route('admin.products.create') }}" class="nav-link">➕ Add Product</a>
            <a href="{{ route('admin.products.import') }}" class="nav-link">📁 Import</a>
        </div>
        <form method="GET" action="{{ route('admin.products.index') }}" class="search-box">
            <input type="text" name="search" class="search-input" placeholder="Search products..." value="{{ request('search') }}" oninput="setTimeout(() => this.form.submit(), 300)" id="searchInput">
        </form>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput && searchInput.value) {
                setTimeout(() => {
                    searchInput.focus();
                    searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
                }, 100);
            }
        });
        </script>
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

<h1>Products Management</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.products.create') }}" class="btn">Add New Product</a>
    <a href="{{ route('admin.products.import') }}" class="btn">Bulk Import</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category }}</td>
            <td>${{ number_format($product->price, 2) }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <a href="{{ route('admin.products.show', $product) }}" class="btn" style="font-size: 12px; padding: 4px 8px;">View</a>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn" style="font-size: 12px; padding: 4px 8px;">Edit</a>
                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="font-size: 12px; padding: 4px 8px;" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align: center;">No products found</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $products->links('pagination.custom') }}
@endsection