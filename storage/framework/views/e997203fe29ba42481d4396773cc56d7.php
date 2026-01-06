<?php $__env->startSection('title', 'Product Details'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo customer-logo">S</div>
        <div class="brand-text">
            <div class="brand-name">ShopHub</div>
            <div class="brand-tagline">Product Details</div>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="<?php echo e(route('customer.dashboard')); ?>" class="nav-link">📦 Products</a>
        </div>
    </div>
    <div class="nav-right">
        <div class="user-menu">
            <div class="user-avatar customer-avatar"><?php echo e(substr(auth('customer')->user()->name, 0, 1)); ?></div>
            <div class="user-info">
                <div class="user-name"><?php echo e(auth('customer')->user()->name); ?></div>
                <div class="user-role">Customer</div>
            </div>
        </div>
        <form method="POST" action="<?php echo e(route('customer.logout')); ?>" style="display: inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</nav>

<div class="card" style="max-width: 800px; margin: 2rem auto;">
    <div class="card-body">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: start;">
            <div>
                <?php if($product->image !== 'default-product.jpg'): ?>
                    <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" style="width: 100%; border-radius: 8px;">
                <?php else: ?>
                    <div style="width: 100%; height: 300px; background: #f7fafc; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #a0aec0;">
                        No Image Available
                    </div>
                <?php endif; ?>
            </div>
            
            <div>
                <h1 style="margin-bottom: 1rem;"><?php echo e($product->name); ?></h1>
                
                <div style="margin-bottom: 1rem;">
                    <span style="background: #667eea; color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem;">
                        <?php echo e($product->category); ?>

                    </span>
                </div>
                
                <div style="font-size: 2rem; font-weight: 700; color: #38a169; margin-bottom: 1rem;">
                    $<?php echo e(number_format($product->price, 2)); ?>

                </div>
                
                <div style="margin-bottom: 1rem;">
                    <strong>Stock:</strong> <?php echo e($product->stock); ?> units available
                </div>
                
                <div style="margin-bottom: 2rem;">
                    <h3 style="margin-bottom: 0.5rem;">Description</h3>
                    <p style="color: #4a5568; line-height: 1.6;"><?php echo e($product->description); ?></p>
                </div>
                
                <div style="display: flex; gap: 1rem;">
                    <button class="btn" style="flex: 1;">Add to Cart</button>
                    <button class="btn" style="background: #38a169;">Buy Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\subha\OneDrive\Desktop\Pro\E-Commerce\resources\views/customer/product-show.blade.php ENDPATH**/ ?>