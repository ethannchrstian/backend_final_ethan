<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Models\Item;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $items = Item::all(); 
    return view('dashboard', compact('items'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('user.cart.view');

});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('items', ItemController::class)->names('admin.items');
    Route::post('/items/store', [ItemController::class, 'store'])->name('admin.items.store');
});


Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{item}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('user.cart.view'); // <-- Added this
    Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('user.cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('user.cart.remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('user.cart.checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('user.cart.processCheckout');
    Route::get('/invoice/{invoice}', [CartController::class, 'showInvoice'])->name('user.cart.invoice');

});





require __DIR__.'/auth.php';
