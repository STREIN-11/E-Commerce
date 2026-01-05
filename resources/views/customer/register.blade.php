@extends('layouts.app')

@section('title', 'Customer Register')

@section('content')
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo customer-logo">C</div>
        <div class="brand-text">
            <div class="brand-name">Customer Registration</div>
            <div class="brand-tagline">Create Customer Account</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="/" class="nav-link">🏠 Home</a>
            <a href="{{ route('admin.register') }}" class="nav-link">🔒 Admin Register</a>
        </div>
    </div>
    <div class="nav-right">
        <a href="{{ route('customer.login') }}" class="btn btn-success">Login as Customer</a>
    </div>
</nav>

<h1>Customer Register</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('customer.register') }}">
    @csrf
    
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    
    <div class="form-group">
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>
    
    <button type="submit" class="btn">Register</button>
</form>
@endsection