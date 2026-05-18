<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/* ── Public ── */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{blogPost:slug}', [BlogController::class, 'show'])->name('blog.show');

/* ── Auth ── */
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.otp');
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

/* ── Admin (protected) ── */
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/images/upload', [ImageUploadController::class, 'upload'])->name('images.upload');

    /* Blog Posts */
    Route::post('/posts', [BlogPostController::class, 'store'])->name('posts.store');
    Route::put('/posts/{blogPost}', [BlogPostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{blogPost}', [BlogPostController::class, 'destroy'])->name('posts.destroy');

    /* Testimonials */
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::patch('/testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::patch('/testimonials/{testimonial}/reject', [TestimonialController::class, 'reject'])->name('testimonials.reject');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    /* Messages */
    Route::patch('/messages/{message}/read', [MessageController::class, 'markRead'])->name('messages.read');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    /* Books */
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    /* Services */
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');

    /* Settings */
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    Route::post('/settings/social', [SettingsController::class, 'updateSocial'])->name('settings.social');
    Route::post('/settings/about', [SettingsController::class, 'updateAbout'])->name('settings.about');
    Route::post('/settings/stats', [SettingsController::class, 'updateStats'])->name('settings.stats');
});
