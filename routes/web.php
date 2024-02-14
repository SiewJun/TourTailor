<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AccountController as AdminAccountController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\user\AccountController as UserAccountController;
use App\Http\Controllers\user\DashboardController as UserDashboardController;
use App\Http\Controllers\DiscoverController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\AdminSupportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TravelTipController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/discover', function () {
    return view('discover');
});
Route::get('/', [AdminDashboardController::class, 'getFeaturedPackages']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/discover', [DiscoverController::class, 'getPackagesListing']);
Route::get('/discover/search', [DiscoverController::class, 'search'])->name('discover.search');
Route::get('/discover/filter', [DiscoverController::class, 'filter'])->name('discover.filter');
Route::get('/travel-tips', [TravelTipController::class, 'index'])->name('travel-tips.index');
Route::get('/travel-tips/{id}', [TravelTipController::class, 'show'])->name('travel-tips.show');


// Reviews routes
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');

// Laravel Auth route
Auth::routes();

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard routes
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::get('users', [AdminDashboardController::class, 'viewUsers'])->name('admin.dashboard.view-users-ajax');
    Route::delete('/admin/users/{id}/delete', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/packages', [AdminDashboardController::class, 'viewPackages'])->name('admin.dashboard.view-packages');
    Route::get('/packages/create', [AdminDashboardController::class, 'createPackage'])->name('admin.dashboard.create-package');
    Route::post('/packages/store', [AdminDashboardController::class, 'storePackage'])->name('admin.dashboard.store-package');
    Route::get('/packages/{id}/edit', [AdminDashboardController::class, 'editPackage'])->name('admin.dashboard.edit-package');
    Route::put('/packages/{id}/update', [AdminDashboardController::class, 'updatePackage'])->name('admin.dashboard.update-package');
    Route::delete('/packages/{id}/delete', [AdminDashboardController::class, 'deletePackage'])->name('admin.dashboard.delete-package');
    Route::get('/bookings', [AdminDashboardController::class, 'viewBookings'])->name('admin.dashboard.view-bookings');
    // Account routes
    Route::get('/account/index', [AdminAccountController::class, 'index'])->name('admin.account.index');
    Route::get('/account/edit', [AdminAccountController::class, 'edit'])->name('admin.account.edit');
    Route::put('/account/update', [AdminAccountController::class, 'update'])->name('admin.account.update');
    Route::get('/account/change-password', [AdminAccountController::class, 'showChangePasswordForm'])->name('admin.account.change-password');
    Route::post('/account/change-password', [AdminAccountController::class, 'changePassword'])->name('admin.account.change-password');
    // Support routes
    Route::get('support', [AdminSupportController::class, 'index'])->name('admin.dashboard.view-support');
    Route::delete('support/{id}/delete', [AdminSupportController::class, 'destroy'])->name('admin.dashboard.delete-support');
    Route::delete('/admin/travel-tips/{id}/destroy', [TravelTipController::class, 'destroy'])->name('admin.travel-tips.destroy');
});

// User routes
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard.index');
    Route::get('/dashboard/view-cart', [UserDashboardController::class, 'viewCart'])->name('user.dashboard.view-cart-ajax');
    Route::post('/cart/add/{package}', [UserDashboardController::class, 'addToCart'])->name('user.dashboard.add-to-cart');
    Route::delete('/cart/{cartItem}', [UserDashboardController::class, 'deleteCartItem'])->name('user.dashboard.delete-cart-item');
    Route::get('/dashboard/view-bookings', [UserDashboardController::class, 'viewBookings'])->name('user.dashboard.view-bookings-ajax');
    // Account routes
    Route::get('/account/index', [UserAccountController::class, 'index'])->name('user.account.index');
    Route::get('/account/edit', [UserAccountController::class, 'edit'])->name('user.account.edit');
    Route::put('/account/update', [UserAccountController::class, 'update'])->name('user.account.update');
    Route::get('/account/change-password', [UserAccountController::class, 'showChangePasswordForm'])->name('user.account.change-password');
    Route::post('/account/change-password', [UserAccountController::class, 'changePassword'])->name('user.account.change-password');
    // Support routes
    Route::get('/support', [SupportController::class, 'index'])->name('user.support.index');
    Route::get('/support/create', [SupportController::class, 'create'])->name('user.support.create');
    Route::post('/support', [SupportController::class, 'store'])->name('user.support.store');
});

// User payment routes
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/payment/success', [PaymentController::class, 'handlePaymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'handlePaymentCancel'])->name('payment.cancel');
});

// Reviews routes
Route::middleware(['auth'])->group(function () {
    // Only users can create and store reviews
    Route::middleware(['user'])->group(function () {
        Route::get('/reviews/create', [ReviewController::class, 'create'])->name('user.reviews.create');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('user.reviews.store');
    });

    // Only admins can delete reviews
    Route::middleware(['admin'])->group(function () {
        Route::delete('/reviews/{id}/destroy', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    });
});

Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/travel-tips/create', [TravelTipController::class, 'create'])->name('user.travel-tips.create');
    Route::post('/travel-tips', [TravelTipController::class, 'store'])->name('user.travel-tips.store');
});

