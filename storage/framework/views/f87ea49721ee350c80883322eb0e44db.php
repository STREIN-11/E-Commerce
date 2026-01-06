<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
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
            <a href="<?php echo e(route('admin.products.index')); ?>" class="nav-link">
                📦 Products
            </a>
            <a href="<?php echo e(route('admin.products.import')); ?>" class="nav-link">
                📁 Import
            </a>
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

<h1>Admin Dashboard</h1>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="online-users">
    <h3>Online Users (Real-time)</h3>
    <div id="online-users-list">
        <span class="user-status">Connecting...</span>
    </div>
</div>

<div style="margin-top: 30px;">
    <h3>Quick Actions</h3>
    <a href="<?php echo e(route('admin.products.index')); ?>" class="btn">Manage Products</a>
    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn">Add New Product</a>
    <a href="<?php echo e(route('admin.products.import')); ?>" class="btn">Bulk Import Products</a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('online-users-list');
    let users = new Set();
    
    // Load initial users from server
    <?php $__currentLoopData = $onlineUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        users.add('<?php echo e($user->name); ?> (<?php echo e(ucfirst($user->type)); ?>)');
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\subha\OneDrive\Desktop\Pro\E-Commerce\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>