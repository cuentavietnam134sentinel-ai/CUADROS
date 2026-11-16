<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomOrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/proceso-artesanal', [HomeController::class, 'process'])->name('process');
Route::get('/cuidados-de-la-pieza', [HomeController::class, 'care'])->name('care');
Route::get('/preguntas-frecuentes', [HomeController::class, 'faq'])->name('faq');
Route::get('/contacto', [HomeController::class, 'contact'])->name('contact');
Route::post('/contacto', [HomeController::class, 'storeContact'])->name('contact.store');
Route::get('/terminos-y-condiciones', [HomeController::class, 'terms'])->name('legal.terms');
Route::get('/politica-de-privacidad', [HomeController::class, 'privacy'])->name('legal.privacy');

// Catalog & Products
Route::get('/galeria', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/galeria/{product:slug}', [CatalogController::class, 'show'])->name('catalog.show');

// Custom Orders
Route::get('/personalizados', [CustomOrderController::class, 'create'])->name('custom.create');
Route::post('/personalizados', [CustomOrderController::class, 'store'])->name('custom.store');

// Cart
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/carrito/actualizar/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito/eliminar/{item}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/exito/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// Guest & Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Customer Area
Route::middleware('auth')->prefix('cuenta')->name('customer.')->group(function () {
    Route::get('/perfil', [CustomerController::class, 'profile'])->name('profile');
    Route::put('/perfil', [CustomerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/pedidos', [CustomerController::class, 'orders'])->name('orders');
    Route::get('/personalizados', [CustomerController::class, 'customRequests'])->name('custom');
    Route::get('/direcciones', [CustomerController::class, 'addresses'])->name('addresses');
    Route::post('/direcciones', [CustomerController::class, 'storeAddress'])->name('addresses.store');
});

// Admin Panel
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/productos', [AdminController::class, 'products'])->name('products');
    Route::get('/productos/crear', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/productos', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/categorias', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categorias', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('/pedidos', [AdminController::class, 'orders'])->name('orders');
    Route::get('/personalizados', [AdminController::class, 'customRequests'])->name('custom_requests');
    Route::put('/personalizados/{customRequest}', [AdminController::class, 'updateCustomRequest'])->name('custom_requests.update');
    Route::get('/mensajes', [AdminController::class, 'messages'])->name('messages');
    Route::get('/resenas', [AdminController::class, 'reviews'])->name('reviews');
});
