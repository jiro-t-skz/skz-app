<?php

use App\Http\Controllers\CommunityController;
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

    Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
    Route::post('community/posts',[CommunityController::class, 'store'])->name('community.posts.store');
    Route::put('/community/posts/{id}',[CommunityController::class, 'update'])->name('community.posts.update');
    Route::delete('community/posts/{id}',[CommunityController::class, 'destroy' ])->name('community.posts.destroy');

    Route::post('/community/posts/{postId}/comments', [CommunityController::class, 'storeComment'])->name('community.comments.store');
    Route::put('/community/comments/{commentId}', [CommunityController::class, 'updateComment'])->name('community.comments.update');
    Route::delete('/community/comments/{commentId}', [CommunityController::class, 'destroyComment'])->name('community.comments.destroy');
});

require __DIR__.'/auth.php';
