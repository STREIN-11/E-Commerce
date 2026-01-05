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
        @foreach($onlineUsers as $user)
            <span class="user-status">{{ $user->name }} ({{ ucfirst($user->type) }})</span>
        @endforeach
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
    // Initialize Echo for real-time presence
    if (window.Echo) {
        window.Echo.join('presence.admin')
            .here((users) => {
                updateOnlineUsers(users);
            })
            .joining((user) => {
                console.log('User joining:', user);
                addOnlineUser(user);
            })
            .leaving((user) => {
                console.log('User leaving:', user);
                removeOnlineUser(user);
            });
    }
    
    function updateOnlineUsers(users) {
        const container = document.getElementById('online-users-list');
        container.innerHTML = '';
        users.forEach(user => {
            const span = document.createElement('span');
            span.className = 'user-status';
            span.textContent = `${user.name} (${user.type.charAt(0).toUpperCase() + user.type.slice(1)})`;
            span.id = `user-${user.id}`;
            container.appendChild(span);
        });
    }
    
    function addOnlineUser(user) {
        const container = document.getElementById('online-users-list');
        const existing = document.getElementById(`user-${user.id}`);
        if (!existing) {
            const span = document.createElement('span');
            span.className = 'user-status';
            span.textContent = `${user.name} (${user.type.charAt(0).toUpperCase() + user.type.slice(1)})`;
            span.id = `user-${user.id}`;
            container.appendChild(span);
        }
    }
    
    function removeOnlineUser(user) {
        const element = document.getElementById(`user-${user.id}`);
        if (element) {
            element.remove();
        }
    }
});
</script>
@endsection