@extends('layouts.app')

@section('title', 'Import Products')

@section('content')
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo">A</div>
        <div class="brand-text">
            <div class="brand-name">AdminHub</div>
            <div class="brand-tagline">Import Products</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">🏠 Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="nav-link">📦 Products</a>
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

<h1>Bulk Import Products</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div style="background: #e7f3ff; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
    <h3>Import Instructions</h3>
    <ul>
        <li>Upload CSV or Excel files with up to 100,000 products</li>
        <li>Required columns: name, description, price, category, stock</li>
        <li>Optional column: image (if empty, default image will be used)</li>
        <li>Processing is done in background using queues to prevent timeouts</li>
        <li>Large files are processed in chunks of 1,000 rows</li>
    </ul>
    
    <h4>Sample CSV Format:</h4>
    <pre style="background: white; padding: 10px; border-radius: 4px;">name,description,price,category,stock,image
"Product 1","Description for product 1",29.99,"Electronics",100,
"Product 2","Description for product 2",19.99,"Books",50,"custom-image.jpg"</pre>
</div>

<form method="POST" action="{{ route('admin.products.import') }}" enctype="multipart/form-data">
    @csrf
    
    <div class="form-group">
        <label for="file">Select CSV/Excel File:</label>
        <input type="file" id="file" name="file" accept=".csv" required>
        <small>Maximum file size: 10MB. Supported formats: CSV</small>
    </div>
    
    <button type="submit" class="btn">Start Import</button>
    <a href="{{ route('admin.products.index') }}" class="btn" style="background: #6c757d;">Cancel</a>
</form>

<div style="margin-top: 30px;">
    <h3>Download Sample File</h3>
    <p>Use the sample file below as a template for your product imports:</p>
    <a href="/products_sample_import.csv" class="btn" download>Download Sample CSV</a>
</div>
@endsection