<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Laravel Assessment'); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #2d3748; line-height: 1.6; min-height: 100vh; }
        .container { max-width: 1600px; margin: 0 auto; background: rgba(255, 255, 255, 0.95); min-height: 100vh; backdrop-filter: blur(10px); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); }
        .nav { background: #1a202c; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #2d3748; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); height: 64px; }
        .nav-brand { display: flex; align-items: center; gap: 0.75rem; }
        .brand-logo { width: 32px; height: 32px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1rem; }
        .customer-logo { background: linear-gradient(135deg, #48bb78, #38a169); }
        .brand-text { display: flex; flex-direction: column; }
        .brand-name { font-size: 1.125rem; font-weight: 700; color: white; }
        .brand-tagline { font-size: 0.75rem; color: #a0aec0; }
        .nav-center { display: flex; align-items: center; gap: 2rem; }
        .nav-links { display: flex; align-items: center; gap: 1rem; }
        .nav-link { color: #e2e8f0; text-decoration: none; padding: 0.5rem 1rem; border-radius: 6px; transition: all 0.2s; font-weight: 500; font-size: 0.875rem; }
        .nav-link:hover { background: #2d3748; color: white; }
        .search-container { position: relative; }

        .search-container form { display: inline; width: 100%; }
        .search-icon { position: absolute; left: 0.25rem; top: 50%; transform: translateY(-50%); color: #2d3748; pointer-events: none; }
        .nav-right { display: flex; align-items: center; gap: 1rem; }
        .user-menu { display: flex; align-items: center; gap: 0.75rem; }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; font-weight: 600; color: white; font-size: 0.875rem; }
        .customer-avatar { background: linear-gradient(135deg, #48bb78, #38a169); }
        .user-info { display: flex; flex-direction: column; }
        .user-name { font-size: 0.875rem; font-weight: 600; color: white; }
        .user-role { font-size: 0.75rem; color: #a0aec0; }
        .logout-btn { background: #e53e3e; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; font-size: 0.875rem; font-weight: 500; cursor: pointer; }
        .logout-btn:hover { background: #c53030; }
        .brand-icon { font-size: 1.5rem; }
        .brand-name { font-size: 1rem; font-weight: 700; }
        .brand-tagline { font-size: 0.65rem; opacity: 0.8; }
        .nav-actions { display: flex; align-items: center; gap: 1.5rem; }
        .search-box {
    display: flex;
    align-items: center;
    background-color: #ffffff;
    border: 1px solid #d1d5db; /* light gray */
    border-radius: 8px;
    padding: 0 0.75rem;
    height: 38px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.search-box:focus-within {
    border-color: #2563eb; /* professional blue */
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
}

.search-input {
    background: transparent;
    border: none;
    color: #111827; /* near-black for readability */
    padding: 0.25rem 0.25rem;
    width: 200px;
    font-size: 0.875rem;
    font-family: inherit;
}

.search-input::placeholder {
    color: #9ca3af; /* muted gray */
}

.search-input:focus {
    outline: none;
}

        .brand-icon { font-size: 1.5rem; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5)); }
        .search-btn { background: rgba(0, 0, 0, 0.3); border: none; color: white; padding: 0.375rem; border-radius: 50%; cursor: pointer; width: 30px; height: 30px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3)); }
        .link-icon { font-size: 0.875rem; filter: drop-shadow(0 1px 2px rgba(0,0,0,0.5)); }
        .nav-link { color: rgba(255, 255, 255, 0.9); text-decoration: none; padding: 0.5rem 1rem; border-radius: 8px; transition: all 0.3s; font-weight: 500; background: rgba(0, 0, 0, 0.2); display: flex; align-items: center; gap: 0.375rem; font-size: 0.875rem; }
        .admin-avatar { background: linear-gradient(135deg, #667eea, #764ba2); }

        .user-name { font-size: 0.75rem; }
        .user-role { font-size: 0.65rem; }
        .logout-btn { margin-left: 0.75rem; padding: 0.25rem 0.75rem; font-size: 0.75rem; }
        .nav-links a { color: rgba(255, 255, 255, 0.9); text-decoration: none; padding: 0.75rem 1.5rem; border-radius: 12px; transition: all 0.3s; font-weight: 500; background: rgba(255, 255, 255, 0.1); margin-right: 0.5rem; }
        .nav-links a:hover { background: rgba(255, 255, 255, 0.2); color: white; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2); }
        .nav-user { display: flex; align-items: center; gap: 1rem; }

        .user-name { display: block; font-weight: 600; font-size: 0.875rem; color: white; }
        .user-role { display: block; font-size: 0.75rem; color: #a0aec0; }
        .content { padding: 2rem; }
        .btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 8px; border: none; cursor: pointer; font-size: 0.875rem; font-weight: 500; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6); }
        .btn-danger { background: #e53e3e; }
        .btn-danger:hover { background: #c53030; box-shadow: 0 4px 12px rgba(229, 62, 62, 0.4); }
        .btn-success { background: #38a169; }
        .btn-success:hover { background: #2f855a; }
        .btn-sm { padding: 0.375rem 0.75rem; font-size: 0.75rem; }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2d3748; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 0.75rem; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s; background: white; }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: #3182ce; box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1); }
        .alert { padding: 1rem; margin-bottom: 1.5rem; border-radius: 8px; font-weight: 500; border-left: 4px solid; }
        .alert-success { background: #f0fff4; color: #22543d; border-color: #38a169; }
        .alert-danger { background: #fed7d7; color: #742a2a; border-color: #e53e3e; }
        .card { background: rgba(255, 255, 255, 0.9); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); overflow: hidden; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .card-header { background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); padding: 1.5rem; border-bottom: 1px solid rgba(226, 232, 240, 0.3); }
        .card-body { padding: 1.5rem; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 1rem; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .table th { background: #f7fafc; font-weight: 600; color: #2d3748; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .table tbody tr:hover { background: #f7fafc; }
        .online-users { background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(235, 248, 255, 0.9) 100%); padding: 1.5rem; border-radius: 16px; margin-bottom: 2rem; border: 1px solid rgba(144, 205, 244, 0.3); backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(102, 126, 234, 0.1); }
        .user-status { display: inline-flex; align-items: center; margin-right: 1rem; padding: 0.375rem 0.75rem; background: #38a169; color: white; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .user-status::before { content: '●'; margin-right: 0.5rem; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem; margin-top: 1.5rem; }
        .product-card { background: rgba(255, 255, 255, 0.9); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 12px; overflow: hidden; transition: all 0.3s; backdrop-filter: blur(10px); }
        .product-card:hover { transform: translateY(-4px) scale(1.01); box-shadow: 0 15px 30px rgba(245, 87, 108, 0.2); border-color: rgba(245, 87, 108, 0.3); }
        .product-card img { width: 100%; height: 200px; object-fit: cover; }
        .product-card-body { padding: 1.5rem; }
        .product-card h4 { color: #2d3748; margin-bottom: 0.75rem; font-size: 1.125rem; font-weight: 600; }
        .product-card p { margin-bottom: 0.5rem; color: #4a5568; font-size: 0.875rem; }
        .product-card .price { font-size: 1.25rem; font-weight: 700; color: #38a169; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center; }
        .stat-number { font-size: 2rem; font-weight: 700; color: #2d3748; }
        .stat-label { color: #4a5568; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .pagination { display: flex; justify-content: center; align-items: center; margin-top: 2rem; gap: 0.25rem; }
        .pagination a, .pagination span { padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; color: #4a5568; text-decoration: none; border-radius: 6px; font-size: 0.875rem; transition: all 0.2s; min-width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; }
        .pagination a:hover { background: #f7fafc; border-color: #cbd5e0; }
        .pagination .current { background: #3182ce; color: white; border-color: #3182ce; }
        .pagination .disabled { color: #a0aec0; cursor: not-allowed; }
        h1 { color: #1a202c; margin-bottom: 1.5rem; font-size: 2.25rem; font-weight: 700; }
        h2 { color: #2d3748; margin-bottom: 1rem; font-size: 1.875rem; font-weight: 600; }
        h3 { color: #2d3748; margin-bottom: 1rem; font-size: 1.5rem; font-weight: 600; }
        .section { margin-bottom: 3rem; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-4 { gap: 1rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mt-4 { margin-top: 1rem; }
    </style>

</head>
<body>
    <div class="container">
        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    
    <script>
        window.Laravel = {
            csrfToken: '<?php echo e(csrf_token()); ?>',
            user: <?php if(auth()->guard()->check()): ?> <?php echo json_encode(auth()->user(), 15, 512) ?> <?php else: ?> null <?php endif; ?>
        };
    </script>
</body>
</html><?php /**PATH C:\Users\subha\OneDrive\Desktop\Assesment\resources\views/layouts/app.blade.php ENDPATH**/ ?>