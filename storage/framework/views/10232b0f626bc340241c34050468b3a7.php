<?php $__env->startSection('title', 'Products Management'); ?>

<?php $__env->startSection('content'); ?>
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
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link">🏠 Dashboard</a>
            <a href="<?php echo e(route('admin.products.create')); ?>" class="nav-link">➕ Add Product</a>
            <a href="<?php echo e(route('admin.products.import')); ?>" class="nav-link">📁 Import</a>
        </div>
        <form method="GET" action="<?php echo e(route('admin.products.index')); ?>" class="search-box">
            <input type="text" name="search" class="search-input" placeholder="Search products..." value="<?php echo e(request('search')); ?>" oninput="setTimeout(() => this.form.submit(), 300)" id="searchInput">
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

<h1>Products Management</h1>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div style="margin-bottom: 20px;">
    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn">Add New Product</a>
    <a href="<?php echo e(route('admin.products.import')); ?>" class="btn">Bulk Import</a>
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
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($product->id); ?></td>
            <td><?php echo e($product->name); ?></td>
            <td><?php echo e($product->category); ?></td>
            <td>$<?php echo e(number_format($product->price, 2)); ?></td>
            <td><?php echo e($product->stock); ?></td>
            <td>
                <a href="<?php echo e(route('admin.products.show', $product)); ?>" class="btn" style="font-size: 12px; padding: 4px 8px;">View</a>
                <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="btn" style="font-size: 12px; padding: 4px 8px;">Edit</a>
                <form method="POST" action="<?php echo e(route('admin.products.destroy', $product)); ?>" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger" style="font-size: 12px; padding: 4px 8px;" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="6" style="text-align: center;">No products found</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php echo e($products->links('pagination.custom')); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\subha\OneDrive\Desktop\Pro\E-Commerce\resources\views/admin/products/index.blade.php ENDPATH**/ ?>