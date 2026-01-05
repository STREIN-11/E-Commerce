# Laravel Assessment - Multi-Auth, WebSockets & Bulk Import

A secure and optimized Laravel web application demonstrating multi-authentication, real-time updates using websockets, and efficient large-scale product import using Laravel queues and batch processing.

## Features Implemented

### ✅ Multi-Authentication System
- Separate login, registration, and dashboards for Admin and Customer users
- Laravel's built-in multi-authentication system using `Auth::guard()`
- Route protection using middleware per guard (`auth:admin`, `auth:customer`)
- Independent session management for each guard

### ✅ Product Management (Admin Features)
- Complete CRUD operations for products
- Product fields: name, description, price, image, category, stock
- Bulk import of up to 100,000 products via CSV/Excel
- Chunked processing using Laravel queues
- Default image handling when no image provided in CSV
- Sample CSV file included: `products_sample_import.csv`

### ✅ Real-Time Updates (WebSockets)
- Real-time user presence using Laravel Reverb
- Online/offline status tracking for Admins and Customers
- Presence channels implementation
- Database storage of user online status
- Live updates in Admin dashboard

### ✅ Optimized Product Import
- CSV/Excel file upload support (up to 100k products)
- Chunked reading and processing (1000 rows per chunk)
- Row-by-row validation
- Background queue processing to prevent timeouts
- Error handling and cleanup

### ✅ Testing Suite
- Feature tests for product creation and management
- Unit tests for bulk import logic and validation
- Multi-auth testing scenarios
- Laravel's built-in test suite integration

## Setup Instructions

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and npm
- SQLite (default) or MySQL/PostgreSQL

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd laravel-assessment
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   # Create SQLite database
   touch database/database.sqlite
   
   # Run migrations
   php artisan migrate
   ```

6. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

7. **Start the application**
   ```bash
   # Terminal 1: Laravel server
   php artisan serve
   
   # Terminal 2: Queue worker
   php artisan queue:work
   
   # Terminal 3: WebSocket server
   php artisan reverb:start
   ```

8. **Access the application**
   - Main app: http://localhost:8000
   - Admin login: http://localhost:8000/admin/login
   - Customer login: http://localhost:8000/customer/login

## Multi-Auth Strategy & Route Protection

### Authentication Guards
The application uses Laravel's multi-guard authentication system:

```php
// config/auth.php
'guards' => [
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
    'customer' => [
        'driver' => 'session',
        'provider' => 'customers',
    ],
],
```

### Route Protection
Routes are protected using custom middleware:

- **AdminMiddleware**: Protects admin routes, redirects to admin login
- **CustomerMiddleware**: Protects customer routes, redirects to customer login

```php
// Admin routes
Route::middleware('admin')->group(function () {
    Route::get('dashboard', [AdminAuthController::class, 'dashboard']);
    Route::resource('products', ProductController::class);
});

// Customer routes  
Route::middleware('customer')->group(function () {
    Route::get('dashboard', [CustomerAuthController::class, 'dashboard']);
});
```

### User Type Differentiation
Users are differentiated by a `type` field in the database:
- `admin`: Full access to product management and admin features
- `customer`: Limited access to customer dashboard

## WebSocket Stack

### Technology Used
- **Laravel Reverb**: Laravel's official WebSocket server
- **Laravel Echo**: Client-side WebSocket library
- **Pusher Protocol**: Compatible WebSocket implementation

### Configuration
```env
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=123456
REVERB_APP_KEY=reverb-key
REVERB_APP_SECRET=reverb-secret
REVERB_HOST="localhost"
REVERB_PORT=8080
```

### Presence Channels
Two presence channels are implemented:
- `presence.admin`: For admin users
- `presence.customer`: For customer users

### Real-time Features
- User join/leave notifications
- Online status tracking in database
- Live user list updates in admin dashboard
- Cross-guard presence visibility (admins can see all users)

## Bulk Import Implementation & Optimizations

### Import Strategy
1. **File Upload**: CSV/Excel files up to 10MB
2. **Queue Processing**: Background job processing
3. **Chunked Reading**: 1000 rows per chunk
4. **Validation**: Row-by-row validation with Laravel rules
5. **Error Handling**: Failed job cleanup and retry logic

### Key Classes
- `ProcessProductImport`: Queue job for background processing
- `ProductsImport`: Import class with chunking and validation
- `ProductController`: Handles file upload and job dispatch

### Optimizations
- **Memory Management**: Chunked processing prevents memory exhaustion
- **Timeout Prevention**: Background queue processing
- **Validation**: Early validation prevents invalid data insertion
- **Default Values**: Automatic default image assignment
- **Cleanup**: Automatic file cleanup after processing

### Performance Features
```php
// Chunked processing
public function chunkSize(): int
{
    return 1000; // Process 1000 rows at a time
}

// Job timeout and retries
public $timeout = 3600; // 1 hour timeout
public $tries = 3; // 3 retry attempts
```

## Testing Guide

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test types
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run with coverage (if xdebug enabled)
php artisan test --coverage
```

### Test Coverage

#### Feature Tests (`tests/Feature/ProductManagementTest.php`)
- ✅ Admin can create products
- ✅ Customer cannot access product management
- ✅ Product creation validation
- ✅ Admin can update products
- ✅ Admin can delete products

#### Unit Tests (`tests/Unit/ProductImportTest.php`)
- ✅ Product import creates correct model
- ✅ Default image handling
- ✅ Validation rules testing
- ✅ Chunk size configuration

### Test Data
- User factories for admin/customer creation
- Product factories for test data generation
- Database refresh for clean test environment

## Architectural & Performance Decisions

### Database Design
- **SQLite**: Default for simplicity and portability
- **Indexes**: Proper indexing on frequently queried fields
- **Foreign Keys**: Maintained data integrity
- **Soft Deletes**: Could be added for audit trails

### Queue System
- **Database Driver**: Simple setup, no external dependencies
- **Job Batching**: Available for tracking import progress
- **Failed Jobs**: Automatic retry and cleanup mechanisms

### Security Measures
- **CSRF Protection**: All forms protected
- **Input Validation**: Comprehensive validation rules
- **File Upload Security**: Type and size restrictions
- **Authentication**: Secure password hashing
- **Route Protection**: Middleware-based access control

### Performance Optimizations
- **Lazy Loading**: Efficient database queries
- **Chunked Processing**: Memory-efficient bulk operations
- **Asset Optimization**: Vite for modern asset building
- **Caching**: Ready for Redis/Memcached integration

### Scalability Considerations
- **Queue Workers**: Horizontal scaling capability
- **WebSocket Scaling**: Reverb supports clustering
- **Database**: Easy migration to MySQL/PostgreSQL
- **File Storage**: Ready for S3/cloud storage integration

## Sample Data

The `products_sample_import.csv` file contains 20 sample products with:
- Various categories (Electronics, Books, Clothing, Home, Sports)
- Different price ranges ($12.99 - $149.99)
- Stock quantities (25 - 300 units)
- Mix of products with and without custom images
- Realistic product names and descriptions

This file was used for testing the import functionality and demonstrates:
- Proper CSV formatting
- Required vs optional fields
- Default image handling
- Various data types and validation scenarios

## API Endpoints

### Authentication Endpoints
- `GET /admin/login` - Admin login form
- `POST /admin/login` - Admin login processing
- `GET /admin/register` - Admin registration form
- `POST /admin/register` - Admin registration processing
- `POST /admin/logout` - Admin logout

- `GET /customer/login` - Customer login form
- `POST /customer/login` - Customer login processing
- `GET /customer/register` - Customer registration form
- `POST /customer/register` - Customer registration processing
- `POST /customer/logout` - Customer logout

### Product Management (Admin Only)
- `GET /admin/products` - List products
- `GET /admin/products/create` - Create product form
- `POST /admin/products` - Store new product
- `GET /admin/products/{id}` - Show product details
- `GET /admin/products/{id}/edit` - Edit product form
- `PUT /admin/products/{id}` - Update product
- `DELETE /admin/products/{id}` - Delete product
- `GET /admin/products-import` - Import form
- `POST /admin/products-import` - Process import

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for new functionality
5. Ensure all tests pass
6. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).