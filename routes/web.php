<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/categories/{slug}', function (string $slug) {
    // Logic to fetch category details based on $slug
    // ...
  
    // Return the view with category details
    return view('categories.show', compact('category'));
  })->name('category.show');

Route::get('/books', function () {
    return view('books');
})->middleware(['auth', 'verified'])->name('books');

Route::get('/Borrow Book', function () {
    // return view with Borrow Book data
})->name('Borrow Book');

Route::get('/Borrowing History', function () {
    // return view with Borrowing History data
})->name('Borrowing History');

Route::get('/Current Borrowings', function () {
    // return view with Current Borrowings data
})->name('Current Borrowings');

Route::get('/About Us', function () {
    // return view with About Us data
})->name('About Us');

Route::get('/Contact Us', function () {
    // return view with Contact Us data
})->name('Contact Us');
  


require __DIR__.'/auth.php';
