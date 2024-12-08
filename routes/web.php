<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $posts = [];
    if(auth()->check()) {
        $posts = auth()->user()->showPosts()->latest()->get();
    }

    $posts = Post::where('user_id',auth()->id())->get();
    return view('dashboard', ['posts' => $posts]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/post', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('post.index')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/create-post', [PostController::class, 'create'])->name('post.create');
// Blog post related routes
Route::get('/edit-post/{id}', [PostController::class, 'edit']);
Route::put('/edit-post/{id}', [PostController::class, 'update'])->name('post.updatePost');
Route::delete('/delete-post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
require __DIR__.'/auth.php';
