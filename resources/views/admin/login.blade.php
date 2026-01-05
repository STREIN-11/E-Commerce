@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo">A</div>
        <div class="brand-text">
            <div class="brand-name">Laravel Assessment</div>
            <div class="brand-tagline">Multi-Auth System</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="/" class="nav-link">🏠 Home</a>
            <a href="{{ route('customer.login') }}" class="nav-link">👤 Customer Login</a>
        </div>
    </div>
    <div class="nav-right">
        <a href="{{ route('admin.register') }}" class="btn">Register as Admin</a>
    </div>
</nav>

<h1>Admin Login</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('admin.login') }}">
    @csrf
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    
    <button type="submit" class="btn">Login</button>
</form>
@endsection