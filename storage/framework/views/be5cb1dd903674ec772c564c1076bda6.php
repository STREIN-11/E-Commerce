<?php $__env->startSection('title', 'Product Details'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo">A</div>
        <div class="brand-text">
            <div class="brand-name">AdminHub</div>
            <div class="brand-tagline">Product Details</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link">🏠 Dashboard</a>
            <a href="<?php echo e(route('admin.products.index')); ?>" class="nav-link">📦 Products</a>
            <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="nav-link">✏️ Edit</a>
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

<h1>Product Details</h1>

<div style="background: #f8f9fa; padding: 20px; border-radius: 8px;">
    <h2><?php echo e($product->name); ?></h2>
    
    <div style="margin: 15px 0;">
        <strong>Description:</strong>
        <p><?php echo e($product->description); ?></p>
    </div>
    
    <div style="margin: 15px 0;">
        <strong>Price:</strong> $<?php echo e(number_format($product->price, 2)); ?>

    </div>
    
    <div style="margin: 15px 0;">
        <strong>Category:</strong> <?php echo e($product->category); ?>

    </div>
    
    <div style="margin: 15px 0;">
        <strong>Stock:</strong> <?php echo e($product->stock); ?> units
    </div>
    
    <div style="margin: 15px 0;">
        <strong>Image:</strong> 
        <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" style="max-width: 200px; height: auto; border-radius: 8px; margin-top: 10px;">
    </div>
    
    <div style="margin: 15px 0;">
        <strong>Created:</strong> <?php echo e($product->created_at->format('M d, Y H:i')); ?>

    </div>
    
    <div style="margin: 15px 0;">
        <strong>Updated:</strong> <?php echo e($product->updated_at->format('M d, Y H:i')); ?>

    </div>
</div>

<div style="margin-top: 20px;">
    <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="btn">Edit Product</a>
    <a href="<?php echo e(route('admin.products.index')); ?>" class="btn" style="background: #6c757d;">Back to Products</a>
    
    <form method="POST" action="<?php echo e(route('admin.products.destroy', $product)); ?>" style="display: inline;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete Product</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\subha\OneDrive\Desktop\Pro\E-Commerce\resources\views/admin/products/show.blade.php ENDPATH**/ ?>