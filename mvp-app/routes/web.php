<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\Community\NormalController;
use App\Http\Controllers\Community\TradeController;
use App\Http\Controllers\Community\OffmeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/community', [CommunityController::class, 'index'])->name('community.index');

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //投稿
    Route::prefix('community/normal')->name('community.normal.')->group(function () {
        Route::post('/posts',[NormalController::class, 'storeNormal'])->name('posts.store');
        Route::put('/posts/{id}',[NormalController::class, 'updateNormal'])->name('posts.update');
        Route::delete('/posts/{id}',[NormalController::class, 'destroyNormal' ])->name('posts.destroy');
    //コメント
        Route::post('/posts/{postId}/comments', [NormalController::class, 'storeNormalComment'])->name('comments.store');
        Route::put('/comments/{commentId}', [NormalController::class, 'updateNormalComment'])->name('comments.update');
        Route::delete('/comments/{commentId}', [NormalController::class, 'destroyNormalComment'])->name('comments.destroy');
   });

    //同行者・トレード募集の投稿
    Route::prefix('community/trade')->name('community.trade.')->group(function () {
        Route::post('/posts',[TradeController::class, 'storeTrade'])->name('posts.store');
        Route::put('/posts/{id}',[TradeController::class, 'updateTrade'])->name('posts.update');
        Route::delete('/posts/{id}',[TradeController::class, 'destroyTrade' ])->name('posts.destroy');
    //同行者募・トレードのコメント
        Route::post('/posts/{postId}/comments', [TradeController::class, 'storeTradeComment'])->name('comments.store');
        Route::put('/comments/{commentId}', [TradeController::class, 'updateTradeComment'])->name('comments.update');
        Route::delete('/comments/{commentId}', [TradeController::class, 'destroyTradeComment'])->name('comments.destroy');
   });

    //オフ会の投稿
    Route::prefix('community/offmeeting')->name('community.offmeeting.')->group(function(){
        Route::post('/posts', [OffmeetingController::class, 'storeOffmeeting'])->name('posts.store');
        Route::put('/posts/{id}', [OffmeetingController::class, 'updateOffmeeting'])->name('posts.update');
        Route::delete('/posts/{id}', [OffmeetingController::class, 'destroyOffmeeting'])->name('posts.destroy');
    //同行者募集・トレードのコメント
        Route::post('/posts/{postId}/comments', [OffmeetingController::class, 'storeOffmeetingComment'])->name('comments.store');
        Route::put('/comments/{commentId}', [OffmeetingController::class, 'updateOffmeetingComment'])->name('comments.update');
        Route::delete('/comments/{commentId}', [OffmeetingController::class, 'destroyOffmeetingComment'])->name('comments.destroy');
   });


});

require __DIR__.'/auth.php';




