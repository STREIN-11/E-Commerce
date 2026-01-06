@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo">A</div>
        <div class="brand-text">
            <div class="brand-name">AdminHub</div>
            <div class="brand-tagline">Management Panel</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="{{ route('admin.products.index') }}" class="nav-link">
                📦 Products
            </a>
            <a href="{{ route('admin.products.import') }}" class="nav-link">
                📁 Import
            </a>
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

<h1>Admin Dashboard</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="online-users">
    <h3>Online Users (Real-time)</h3>
    <div id="online-users-list">
        <span class="user-status">Connecting...</span>
    </div>
</div>

<div style="margin-top: 30px;">
    <h3>Quick Actions</h3>
    <a href="{{ route('admin.products.index') }}" class="btn">Manage Products</a>
    <a href="{{ route('admin.products.create') }}" class="btn">Add New Product</a>
    <a href="{{ route('admin.products.import') }}" class="btn">Bulk Import Products</a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('online-users-list');
    let users = new Set();
    
    // Load initial users from server
    @foreach($onlineUsers as $user)
        users.add('{{ $user->name }} ({{ ucfirst($user->type) }})');
    @endforeach
    updateDisplay();
    
    setTimeout(() => {
        if (window.Echo) {
            console.log('Echo connected, listening for events...');
            
            window.Echo.channel('online-users')
                .listen('.user-online', (e) => {
                    console.log('User online event:', e);
                    addUser(e.user);
                })
                .listen('.user-offline', (e) => {
                    console.log('User offline event:', e);
                    removeUser(e.user);
                });
        }
    }, 1000);
    
    function addUser(user) {
        const userStr = `${user.name} (${user.type.charAt(0).toUpperCase() + user.type.slice(1)})`;
        users.add(userStr);
        updateDisplay();
    }
    
    function removeUser(user) {
        const userStr = `${user.name} (${user.type.charAt(0).toUpperCase() + user.type.slice(1)})`;
        users.delete(userStr);
        updateDisplay();
    }
    
    function updateDisplay() {
        container.innerHTML = '';
        if (users.size === 0) {
            container.innerHTML = '<span class="user-status">No users online</span>';
            return;
        }
        users.forEach(userStr => {
            const span = document.createElement('span');
            span.className = 'user-status';
            span.textContent = userStr;
            container.appendChild(span);
        });
    }
});
</script>
@endsection