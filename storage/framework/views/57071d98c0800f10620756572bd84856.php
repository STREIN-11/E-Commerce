<?php $__env->startSection('title', 'Import Products'); ?>

<?php $__env->startSection('content'); ?>
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
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link">🏠 Dashboard</a>
            <a href="<?php echo e(route('admin.products.index')); ?>" class="nav-link">📦 Products</a>
        </div>
    </div>
    <div class="nav-right">
        <div class="user-menu">
            <div class="user-avatar"><?php echo e(substr(auth('admin')->user()->name, 0, 1)); ?></div>
            <div class="user-info">
                <div class="user-name"><?php echo e(auth('admin')->user()->name); ?></div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="<?php echo e(route('admin.logout')); ?>" style="display: inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</nav>

<h1>Bulk Import Products</h1>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo e($error); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

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

<form method="POST" action="<?php echo e(route('admin.products.import')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    
    <div class="form-group">
        <label for="file">Select CSV/Excel File:</label>
        <input type="file" id="file" name="file" accept=".csv" required>
        <small>Maximum file size: 10MB. Supported formats: CSV</small>
    </div>
    
    <button type="submit" class="btn">Start Import</button>
    <a href="<?php echo e(route('admin.products.index')); ?>" class="btn" style="background: #6c757d;">Cancel</a>
</form>

<div style="margin-top: 30px;">
    <h3>Download Sample File</h3>
    <p>Use the sample file below as a template for your product imports:</p>
    <a href="/products_sample_import.csv" class="btn" download>Download Sample CSV</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\subha\OneDrive\Desktop\Pro\E-Commerce\resources\views/admin/products/import.blade.php ENDPATH**/ ?>