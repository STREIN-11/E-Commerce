@extends('layouts.app')

@section('title', 'Welcome - Laravel Assessment')

@section('content')
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo">L</div>
        <div class="brand-text">
            <div class="brand-name">Laravel App</div>
            <div class="brand-tagline">Welcome Portal</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="{{ route('admin.login') }}" class="nav-link">🔒 Admin</a>
            <a href="{{ route('customer.login') }}" class="nav-link">👤 Customer</a>
        </div>
    </div>
    <div class="nav-right">
        <a href="{{ route('admin.register') }}" class="btn btn-sm">Register</a>
    </div>
</nav>

<h1>Welcome to Our Platform</h1>
<p>Choose your access level to get started.</p>

<div style="margin-top: 30px;">
    <h3>Admin Access</h3>
    <a href="{{ route('admin.login') }}" class="btn">Admin Login</a>
    <a href="{{ route('admin.register') }}" class="btn">Admin Register</a>
</div>

<div style="margin-top: 30px;">
    <h3>Customer Access</h3>
    <a href="{{ route('customer.login') }}" class="btn btn-success">Customer Login</a>
    <a href="{{ route('customer.register') }}" class="btn btn-success">Customer Register</a>
</div>
@endsection