<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Authentication API Endpoints
Route::post('/login', function (Request $request) {
    $fields = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string'
    ]);

    // Check email
    $user = User::where('email', $fields['email'])->first();

    // Check password
    if (!$user || !Hash::check($fields['password'], $user->password)) {
        return response([
            'message' => 'Identifiants incorrects'
        ], 401);
    }

    $token = $user->createToken('myapptoken')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 200);
});

Route::post('/register', function (Request $request) {
    $fields = $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|unique:users,email|email',
        'password' => 'required|string|min:6',
        'role' => 'string'
    ]);

    $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => Hash::make($fields['password']),
        'role' => $fields['role'] ?? 'utilisateur'
    ]);

    $token = $user->createToken('myapptoken')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
});

// Protected API Routes
Route::middleware('auth:sanctum')->group(function () {
    
    // User Profile
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response([
            'message' => 'Déconnecté avec succès'
        ], 200);
    });

    // --- Products CRUD ---
    Route::get('/products', function () {
        return Product::with('category')->get();
    });

    Route::post('/products', function (Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|string'
        ]);

        return Product::create($fields);
    });

    Route::get('/products/{id}', function ($id) {
        return Product::with('category')->findOrFail($id);
    });

    Route::put('/products/{id}', function (Request $request, $id) {
        $product = Product::findOrFail($id);
        
        $fields = $request->validate([
            'name' => 'string',
            'description' => 'nullable|string',
            'price' => 'numeric',
            'quantity' => 'integer',
            'category_id' => 'exists:categories,id',
            'image' => 'nullable|string'
        ]);

        $product->update($fields);
        return $product;
    });

    Route::delete('/products/{id}', function ($id) {
        return Product::destroy($id);
    });

    // --- Categories CRUD ---
    Route::get('/categories', function () {
        return Category::all();
    });

    Route::post('/categories', function (Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        return Category::create($fields);
    });

    Route::get('/categories/{id}', function ($id) {
        return Category::findOrFail($id);
    });

    Route::put('/categories/{id}', function (Request $request, $id) {
        $category = Category::findOrFail($id);

        $fields = $request->validate([
            'name' => 'string',
            'description' => 'nullable|string'
        ]);

        $category->update($fields);
        return $category;
    });

    Route::delete('/categories/{id}', function ($id) {
        return Category::destroy($id);
    });
});
