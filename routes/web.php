<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});


// Protected Routes (tous les utilisateurs connectés)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', function () {
        $products = \App\Models\Product::with('category')->get();
        $categories = \App\Models\Category::with('products')->get();
        $totalProducts = \App\Models\Product::count();
        $totalCategories = \App\Models\Category::count();
        $lowStock = \App\Models\Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->whereColumn('products.quantity', '<=', 'categories.seuil_alerte')
            ->count();
        $totalUsers = \App\Models\User::count();
        return view('dashboard', compact('products', 'categories', 'totalProducts', 'totalCategories', 'lowStock', 'totalUsers'));
    })->name('dashboard');

    // Routes Admin uniquement
    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', App\Http\Controllers\CategoryController::class);
        Route::resource('products', App\Http\Controllers\ProductController::class);
    });
});
