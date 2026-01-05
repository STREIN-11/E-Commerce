# Laravel Assessment - Quick Start Guide

## 🚀 Project Overview

This Laravel application demonstrates:
- **Multi-Authentication System** (Admin/Customer guards)
- **Real-time WebSocket Updates** (User presence tracking)
- **Bulk Product Import** (Up to 100k products with queue processing)
- **Complete CRUD Operations** (Product management)
- **Comprehensive Testing** (Feature & Unit tests)

## 📁 Key Files & Directories

### Authentication System
- `app/Http/Controllers/AdminAuthController.php` - Admin authentication
- `app/Http/Controllers/CustomerAuthController.php` - Customer authentication
- `app/Http/Middleware/AdminMiddleware.php` - Admin route protection
- `app/Http/Middleware/CustomerMiddleware.php` - Customer route protection
- `config/auth.php` - Multi-guard configuration

### Product Management
- `app/Http/Controllers/ProductController.php` - CRUD operations
- `app/Models/Product.php` - Product model
- `app/Jobs/ProcessProductImport.php` - Background import job
- `app/Imports/ProductsImport.php` - Excel/CSV import logic
- `public/products_sample_import.csv` - Sample data for testing

### Real-time Features
- `routes/channels.php` - WebSocket presence channels
- `config/broadcasting.php` - WebSocket configuration
- `resources/js/app.js` - Frontend WebSocket setup

### Testing
- `tests/Feature/ProductManagementTest.php` - Feature tests
- `tests/Unit/ProductImportTest.php` - Unit tests

### Views
- `resources/views/admin/` - Admin interface
- `resources/views/customer/` - Customer interface
- `resources/views/layouts/app.blade.php` - Main layout

## ⚡ Quick Installation

### Option 1: Automated (Windows)
```bash
# Run the installation script
install.bat

# Start all services
start.bat
```

### Option 2: Manual
```bash
# Install dependencies
composer install
npm install

# Setup environment
php artisan key:generate
php artisan migrate

# Build assets
npm run build

# Start services (3 separate terminals)
php artisan serve          # Terminal 1
php artisan queue:work      # Terminal 2  
php artisan reverb:start    # Terminal 3
```

## 🔗 Access Points

- **Main App**: http://localhost:8000
- **Admin Login**: http://localhost:8000/admin/login
- **Customer Login**: http://localhost:8000/customer/login

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test suites
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit
```

## 📊 Sample Data

Use `public/products_sample_import.csv` to test bulk import:
- 20 sample products
- Various categories and price ranges
- Mix of products with/without custom images
- Demonstrates validation and default image handling

## 🔧 Key Features Demonstrated

### Multi-Authentication
- Separate admin/customer login systems
- Independent session management
- Route-level protection with middleware
- User type differentiation in database

### Real-time Updates
- WebSocket presence channels
- Online/offline status tracking
- Live user list in admin dashboard
- Database persistence of user status

### Bulk Import Optimization
- Chunked processing (1000 rows/chunk)
- Background queue processing
- Memory-efficient handling
- Comprehensive validation
- Error handling and cleanup

### Testing Coverage
- Product CRUD operations
- Multi-auth scenarios
- Import logic validation
- Security and access control

## 🏗️ Architecture Highlights

- **Queue System**: Database-driven for simplicity
- **WebSockets**: Laravel Reverb for real-time features
- **File Processing**: Chunked imports prevent timeouts
- **Security**: CSRF protection, input validation, route guards
- **Performance**: Optimized queries, efficient asset building

## 📝 Next Steps

1. Run the application using installation scripts
2. Test multi-auth by creating admin/customer accounts
3. Try bulk product import with sample CSV
4. Observe real-time presence in admin dashboard
5. Run test suite to verify functionality

For detailed documentation, see README.md