<?php $__env->startSection('title', 'Customer Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav">
    <div class="nav-brand">
        <div class="brand-logo customer-logo">S</div>
        <div class="brand-text">
            <div class="brand-name">ShopHub</div>
            <div class="brand-tagline">Customer Portal</div>
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

<h1>Customer Dashboard</h1>

<p>Welcome to your customer dashboard. You are now logged in as a customer.</p>

<div style="margin-top: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3>Available Products</h3>
        <div class="search-container" style="display: flex; align-items: center; gap: 0.5rem;">
            <span class="search-icon" style="position: static; transform: none; color: #48bb78;">🔍</span>
            <form method="GET" action="<?php echo e(route('customer.dashboard')); ?>" style="display: inline; width: 100%;" id="searchForm">
                <input type="text" name="search" placeholder="Search products..." style="background: #f0fff4; border: 2px solid #48bb78; color: #22543d; padding: 0.5rem; border-radius: 8px; width: 250px; font-size: 0.875rem;" value="<?php echo e(request('search')); ?>" id="searchInput">
            </form>
        </div>
    </div>
    <?php if($products->count() > 0): ?>
        <div class="product-grid">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product-card" onclick="window.location.href='<?php echo e(route('customer.product.show', $product)); ?>'" style="cursor: pointer;">
                <?php if($product->image !== 'default-product.jpg'): ?>
                    <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>">
                <?php endif; ?>
                <div class="product-card-body">
                    <h4><?php echo e($product->name); ?></h4>
                    <p><strong>Category:</strong> <?php echo e($product->category); ?></p>
                    <p class="price">$<?php echo e(number_format($product->price, 2)); ?></p>
                    <p><strong>Stock:</strong> <?php echo e($product->stock); ?> units</p>
                    <p style="color: #4a5568;"><?php echo e(Str::limit($product->description, 100)); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <div style="margin-top: 20px;">
            <?php echo e($products->links('pagination.custom')); ?>

        </div>
    <?php else: ?>
        <p>No products available. Admin needs to add products first.</p>
        <p><em>Tip: Login as admin to add products or import the sample CSV file.</em></p>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-search functionality
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const currentValue = this.value;
            const cursorPosition = this.selectionStart;
            
            searchTimeout = setTimeout(function() {
                // Store cursor position before form submission
                sessionStorage.setItem('searchCursor', cursorPosition);
                sessionStorage.setItem('searchValue', currentValue);
                searchForm.submit();
            }, 500);
        });
        
        // Restore cursor position after page load
        const savedCursor = sessionStorage.getItem('searchCursor');
        const savedValue = sessionStorage.getItem('searchValue');
        if (savedCursor && savedValue === searchInput.value) {
            searchInput.focus();
            searchInput.setSelectionRange(savedCursor, savedCursor);
            sessionStorage.removeItem('searchCursor');
            sessionStorage.removeItem('searchValue');
        }
    }
    
    // Initialize Echo for customer presence
    if (window.Echo) {
        window.Echo.join('presence.customer')
            .here((users) => {
                console.log('Current customers online:', users);
            })
            .joining((user) => {
                console.log('Customer joining:', user);
            })
            .leaving((user) => {
                console.log('Customer leaving:', user);
            });
    }
});

// Product details modal
function showProductDetails(id, name, category, price, stock, description) {
    alert(`Product: ${name}\nCategory: ${category}\nPrice: $${price}\nStock: ${stock} units\nDescription: ${description}`);
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\subha\OneDrive\Desktop\Pro\E-Commerce\resources\views/customer/dashboard.blade.php ENDPATH**/ ?>