<?php $__env->startSection('title', 'Customer Login'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo customer-logo">C</div>
        <div class="brand-text">
            <div class="brand-name">Laravel Assessment</div>
            <div class="brand-tagline">Multi-Auth System</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="/" class="nav-link">🏠 Home</a>
            <a href="<?php echo e(route('admin.login')); ?>" class="nav-link">🔒 Admin Login</a>
        </div>
    </div>
    <div class="nav-right">
        <a href="<?php echo e(route('customer.register')); ?>" class="btn btn-success">Register as Customer</a>
    </div>
</nav>

<h1>Customer Login</h1>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo e($error); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('customer.login')); ?>">
    <?php echo csrf_field(); ?>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    
    <button type="submit" class="btn">Login</button>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\subha\OneDrive\Desktop\Pro\E-Commerce\resources\views/customer/login.blade.php ENDPATH**/ ?>