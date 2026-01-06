<?php $__env->startSection('title', 'Create Product'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo">A</div>
        <div class="brand-text">
            <div class="brand-name">AdminHub</div>
            <div class="brand-tagline">Create Product</div>
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

<h1>Create New Product</h1>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo e($error); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('admin.products.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    
    <div class="form-group">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required><?php echo e(old('description')); ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo e(old('price')); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo e(old('category')); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="stock">Stock Quantity:</label>
        <input type="number" id="stock" name="stock" min="0" value="<?php echo e(old('stock')); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="image">Product Image (optional):</label>
        <input type="file" id="image" name="image" accept="image/*">
        <small>If no image is provided, a default image will be used.</small>
    </div>
    
    <button type="submit" class="btn">Create Product</button>
    <a href="<?php echo e(route('admin.products.index')); ?>" class="btn" style="background: #6c757d;">Cancel</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\subha\OneDrive\Desktop\Pro\E-Commerce\resources\views/admin/products/create.blade.php ENDPATH**/ ?>