<?php

use App\Http\Controllers\Guest\CategoryController;
use App\Http\Controllers\Guest\LocationController;
use App\Http\Controllers\Guest\PhoneController;
use App\Http\Controllers\Staff\MessageController;
use App\Http\Controllers\Staff\ProfileController;
use App\Http\Controllers\Staff\HomeController;
use App\Http\Controllers\Staff\OrderController;
use App\Http\Controllers\Staff\Auth\ForgotPasswordController;
use App\Http\Controllers\Staff\Auth\ResetPasswordController;
use App\Http\Controllers\Staff\Auth\SignInController;
use App\Http\Controllers\Staff\Auth\SignUpController;
use App\Http\Controllers\Staff\RequestController;
use App\Http\Controllers\Staff\QRController;
use App\Http\Controllers\User\FeedbackStaffController;
use App\Http\Controllers\User\ForgetPasswordController;
use App\Http\Controllers\User\SignInController as UserSignInController;
use App\Http\Controllers\User\SignUpController as UserSignUpController;
use App\Http\Controllers\User\ResetPasswordController as UserResetPasswordController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\RequestedStaffsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StaffsSearchingController;
use App\Http\Controllers\CategoriesListController;
use App\Http\Controllers\UserChatController;
use App\Http\Controllers\UserBlogController;

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

Route::prefix('staff/auth')->middleware('unauth:staff')->group(function () {
    Route::get('signup', [SignUpController::class, 'create'])->name('staff.signup.create');
    Route::post('signup', [SignUpController::class, 'store'])->name('staff.signup.store');
    Route::get('signin', [SignInController::class, 'create'])->name('staff.signin.create');
    Route::post('signin', [SignInController::class, 'store'])->name('staff.signin.store');
    Route::get('forgot-password', [ForgotPasswordController::class, 'create'])->name('staff.forgot-password.create');
    Route::post('forgot-password', [ForgotPasswordController::class, 'store'])->name('staff.forgot-password.store');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'edit'])->name('staff.reset-password.edit');
    Route::patch('reset-password', [ResetPasswordController::class, 'update'])->name('staff.reset-password.update');
});

Route::prefix('s')->middleware('auth:staff')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('staff.home');
    Route::get('requests/{request}', [RequestController::class, 'show'])->name('staff.requests.show');
    Route::patch('requests/{request}', [RequestController::class, 'update'])->name('staff.requests.update');
    Route::get('my-qr', [QRController::class, 'index'])->name('staff.qrcode');
    Route::get('buy-request', [OrderController::class, 'create'])->name('staff.order.create');
    Route::post('buy-request', [OrderController::class, 'store'])->name('staff.order.store');
    Route::get('buy-requests', [OrderController::class, 'history'])->name('staff.order.history');
    Route::get('buy-request/success', [OrderController::class, 'success'])->name('staff.order.success');
    Route::get('buy-request/cancel', [OrderController::class, 'cancel'])->name('staff.order.cancel');
    Route::name('staff.profile.')->group(function () {
        Route::get('profile', [ProfileController::class, 'index'])->name('index');
        Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('edit', [ProfileController::class, 'update'])->name('update');
    });
    Route::post('signout', [SignInController::class, 'destroy'])->name('staff.signout');
    Route::get('chat/{modelsRequest}', [MessageController::class, 'show'])->name('staff.chat.show');
    Route::get('messages/{modelsRequest}', [MessageController::class, 'index'])->name('staff.messages.index');
    Route::post('messages/{modelsRequest}', [MessageController::class, 'store'])->name('staff.messages.store');
});

Route::get('/', [UserHomeController::class, 'index'])->name('user.home');

Route::middleware('unauth:web')->group(function () {
    Route::get('search', [UserHomeController::class, 'search'])->name('search');
    Route::get('signin', [UserSignInController::class, 'signin'])->name('signin');
    Route::post('signin', [UserSignInController::class, 'submitSignin'])->name('signin.submit');
    Route::get('signup', [UserSignUpController::class, 'signup'])->name('signup');
    Route::post('signup', [UserSignUpController::class, 'postSignup'])->name('signup.submit');
    Route::get('forget-password', [ForgetPasswordController::class, 'create'])->name('forget-password');
    Route::post('submit-otp', [ForgetPasswordController::class, 'store'])->name('submit-otp');
    Route::get('reset-password/{token}', [UserResetPasswordController::class, 'edit'])->name('reset-password.edit');
    Route::patch('reset-password', [UserResetPasswordController::class, 'update'])->name('reset-password.update');
});

Route::middleware('auth:web')->group(function () {
    Route::get('profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('logout', [UserProfileController::class, 'destroy'])->name('logout');
    Route::get('requested-staffs', [RequestedStaffsController::class, 'index'])->name('requested-staffs.index');
    Route::get('staff/{staff}/review', [FeedbackStaffController::class, 'index'])->name('feedback-staff.index');
    Route::post('staff/{staff}/review', [FeedbackStaffController::class, 'store'])->name('feedback-staff.store');
});

Route::middleware('auth:web')->group(function () {
    Route::get('profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('logout', [UserProfileController::class, 'destroy'])->name('logout');
});

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('provinces', [LocationController::class, 'getAllProvinces'])->name('provinces.index');
Route::get('provinces/{province}/districts', [LocationController::class, 'getDistrictsByProvince'])->name('provinces.districts.index');
Route::get('districts/{district}/wards', [LocationController::class, 'getWardsByDistrict'])->name('districts.wards.index');
Route::post('send-otp', [PhoneController::class, 'sendOTP'])->name('otp.send');

// Contact
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

//Staffs-searching
Route::get('/staffs-searching', [StaffsSearchingController::class, 'staffsSearching'])->name('staffs-searching');
Route::post('/staffs-searching', [StaffsSearchingController::class, 'sendRequest'])->middleware('auth:web')->name('request.send');

Route::get('categories-list', [CategoriesListController::class, 'categoriesList'])->name('categories-list');

//Chat
Route::get('chat/{modelsRequest}', [UserChatController::class, 'show'])->name('chat.show');
Route::get('messages/{modelsRequest}', [UserChatController::class, 'index'])->name('messages.index');
Route::post('messages/{modelsRequest}', [UserChatController::class, 'store'])->name('messages.store');

// Blog
Route::get('blogs', [UserBlogController::class, 'index'])->name('blogs.index');
Route::get('blogs/{slug}', [UserBlogController::class, 'show'])->name('blogs.pick');
