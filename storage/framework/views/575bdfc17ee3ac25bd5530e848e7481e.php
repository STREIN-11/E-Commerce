<?php $__env->startSection('title', 'Welcome - Laravel Assessment'); ?>

<?php $__env->startSection('content'); ?>
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
            <a href="<?php echo e(route('admin.login')); ?>" class="nav-link">🔒 Admin</a>
            <a href="<?php echo e(route('customer.login')); ?>" class="nav-link">👤 Customer</a>
        </div>
    </div>
    <div class="nav-right">
        <a href="<?php echo e(route('admin.register')); ?>" class="btn btn-sm">Register</a>
    </div>
</nav>

<h1>Welcome to Our Platform</h1>
<p>Choose your access level to get started.</p>

<div style="margin-top: 30px;">
    <h3>Admin Access</h3>
    <a href="<?php echo e(route('admin.login')); ?>" class="btn">Admin Login</a>
    <a href="<?php echo e(route('admin.register')); ?>" class="btn">Admin Register</a>
</div>

<div style="margin-top: 30px;">
    <h3>Customer Access</h3>
    <a href="<?php echo e(route('customer.login')); ?>" class="btn btn-success">Customer Login</a>
    <a href="<?php echo e(route('customer.register')); ?>" class="btn btn-success">Customer Register</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\subha\OneDrive\Desktop\Pro\E-Commerce\resources\views/welcome.blade.php ENDPATH**/ ?>