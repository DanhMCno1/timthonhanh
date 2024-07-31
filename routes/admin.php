<?php


use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\BannerController;

use App\Http\Controllers\Admin\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SignInController;
use App\Http\Controllers\Admin\StaffAccountController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\BlogController;

Route::middleware('unauth:admin')->group(function () {
    Route::get('admin/signin', [SignInController::class, 'create'])->name('admin.signin');
    Route::post('admin/signin', [SignInController::class, 'store']);
});

Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    Route::resource('orders', OrderController::class);
    Route::resource('staffaccount', StaffAccountController::class);
    Route::get('chats', [ChatController::class, 'index'])->name('chats');
    Route::get('chats/{modelsRequest}', [ChatController::class, 'show'])->name('chat.request');
    Route::get('chats/{modelsRequest}/{page}', [ChatController::class, 'load'])->name('chat.load');
    Route::get('genres', [GenreController::class, 'index'])->name('genres.index');
    Route::resource('blogs', BlogController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('banners', BannerController::class);
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::patch('contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
});
Route::post('staff/unban/{id}', [StaffAccountController::class, 'unban'])->name('staff.unban');
