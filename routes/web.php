<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\GoogleController;

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Route::get('/', function () {
//     return view('welcome');
// })->name('/');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', App\Livewire\Admin\Main::class)->name('dashboard');
    Route::get('admin/categories', App\Livewire\Admin\Categories\Categories::class)->name('categories');
    Route::get('admin/products', App\Livewire\Admin\Products\Products::class)->name('products');
    Route::get('admin/inventory', App\Livewire\Admin\Inventory\Inventories::class)->name('inventory');
    Route::get('admin/coupon', App\Livewire\Admin\Coupons\Coupons::class)->name('coupons');
    Route::get('admin/orders', App\Livewire\Admin\Orders\Orders::class)->name('admin.orders');
});

Route::get('/', App\Livewire\Website\Main::class)->name('/');
Route::get('shop', App\Livewire\Website\Shop\Shop::class)->name('shop');
Route::get('contact', App\Livewire\Website\Contact\Contact::class)->name('contact');
Route::get('about-us', App\Livewire\Website\Aboutus\Aboutus::class)->name('about');
Route::get('cart', App\Livewire\Website\Cart\Carts::class)->name('cart')->middleware('auth');
Route::get('checkout', App\Livewire\Website\Checkout\Checkout::class)->name('checkout')->middleware('auth');
Route::get('product/{id}/details', App\Livewire\Website\Shop\Productdetails::class)->name('productDetails');
Route::get('favorites', App\Livewire\Website\Favorite\Favorites::class)->name('favorites')->middleware('auth');
Route::get('orders', App\Livewire\Website\Orders\Orders::class)->name('orders')->middleware('auth');



require __DIR__.'/auth.php';
