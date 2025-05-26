<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserPasswordController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingCompanyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\cartController;
use App\Http\Controllers\frontend\shopController;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}', [shopController::class, 'index'])->name('frontend.shop');
Route::get('/product/{id}', [shopController::class, 'product'])->name('frontend.product');
Route::get('/cart', [cartController::class, 'cart'])->name('frontend.cart');
Route::post('/add-to-cart', [cartController::class, 'addToCart'])->name('frontend.addToCart');
Route::post('/update-cart', [cartController::class, 'updateCart'])->name('frontend.updateCart');
Route::post('/remove-from-cart', [cartController::class, 'removeFromCart'])->name('frontend.removeFromCart');
Route::get('/checkout', [cartController::class, 'checkout'])->name('account.checkout');
Route::post('/process-checkout', [cartController::class, 'processCheckout'])->name('account.processCheckout');
Route::get('/thanks/{orderId}', [cartController::class, 'thankyou'])->name('frontend.thankyou');
Route::post('/add-to-wishlist', [HomeController::class, 'addToWishlist'])->name('frontend.addToWishlist');



Route::group(['prefix' => 'account'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('account.profile');
        Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('account.updateProfile');
        Route::post('/update-address', [AuthController::class, 'updateAddress'])->name('account.updateAddress');
        Route::get('/my-orders', [AuthController::class, 'orders'])->name('account.orders');
        Route::get('/wishlist', [AuthController::class, 'wishlist'])->name('account.wishlist');
        Route::delete('/remove-product-wish-list/{id}', [AuthController::class, 'removeProductWishList'])->name('account.removeProductWishList');
        Route::get('/order-detail/{orderId}', [AuthController::class, 'orderDetail'])->name('account.orderDetail');
        Route::get('/logout', [AuthController::class, 'logout'])->name('account.logout');
    });



    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('account.authenticate');
        Route::get('/register', [AuthController::class, 'register'])->name('account.register');
        Route::post('/process-register', [AuthController::class, 'processRegister'])->name('account.processRegister');
        Route::get('/forgot-password', [UserPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/forgot-password', [UserPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/reset-password/{token}', [UserPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset-password', [UserPasswordController::class, 'reset'])->name('password.update');

    });
});



Route::group(['prefix' => 'admin'], function () {
    // Admin Login Routes
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    // Show the password reset request form
    Route::get('password/reset', [AdminAuthController::class, 'showForgotPasswordForm'])->name('admin.password.request');
            
    // Send the password reset link to the admin's email
    Route::post('password/email', [AdminAuthController::class, 'sendResetLinkEmail'])->name('admin.password.email');

    // Show the form for resetting the password (using the token sent via email)
    Route::get('password/reset/{token}', [AdminAuthController::class, 'showResetPasswordForm'])->name('admin.password.reset');

    // Handle the password reset process (set a new password)
    Route::post('password/reset', [AdminAuthController::class, 'resetPassword'])->name('admin.password.update');

});

// Secure Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => AdminMiddleware::class], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // web.php
    Route::get('notifications', [AdminNotificationController::class, 'fetchNotifications'])->name('admin.notifications');


    // Brands
    Route::resource('brands', BrandController::class)->names([
        'index' => 'admin.brands.index',
        'create' => 'admin.brands.create',
        'store' => 'admin.brands.store',
        'show' => 'admin.brands.show',
        'edit' => 'admin.brands.edit',
        'update' => 'admin.brands.update',
        'destroy' => 'admin.brands.destroy',
    ]);

    // Category
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);

    // subcategories
    Route::resource('subcategories', SubcategoryController::class)->names([
        'index' => 'admin.subcategories.index',
        'create' => 'admin.subcategories.create',
        'store' => 'admin.subcategories.store',
        'edit' => 'admin.subcategories.edit',
        'update' => 'admin.subcategories.update',
        'destroy' => 'admin.subcategories.destroy',
    ]);

    // Products
    Route::resource('admin/products', ProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);

    // Shipping Companies
    Route::resource('shipping-companies', ShippingCompanyController::class)->names([
        'index' => 'admin.shipping.index',
        'create' => 'admin.shipping.create',
        'store' => 'admin.shipping.store',
        'edit' => 'admin.shipping.edit',
        'update' => 'admin.shipping.update',
        'destroy' => 'admin.shipping.destroy',
    ]);

    Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories']);
    Route::get('/subcats/{categoryId}', [ProductController::class, 'getUpdatedSubcategories']);
    Route::delete('/products/delete-image', [ProductController::class, 'deleteImage'])->name('products.deleteImage');


    // order routs 
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/order-detail/{id}', [OrderController::class, 'detail'])->name('orders.detail');
    Route::put('/order-update/{id}', [OrderController::class, 'update'])->name('orders.update');


     // users routs 
     Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
     Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
 


    Route::any('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
