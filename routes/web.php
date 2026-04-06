<?php

use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Storage fallback route (untuk production jika symlink tidak bekerja)
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';
    return response()->file($filePath, [
        'Content-Type' => $mimeType,
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*');

// Admin auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLogin'])->name('login')->middleware('guest');
    Route::post('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('login.submit')->middleware('guest');

    Route::middleware(['auth'])->group(function () {
        Route::post('/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Banner
        Route::get('/banner', [App\Http\Controllers\Admin\BannerController::class, 'index'])->name('banner.index');
        Route::post('/banner', [App\Http\Controllers\Admin\BannerController::class, 'update'])->name('banner.update');

        // About / Company
        Route::get('/about', [App\Http\Controllers\Admin\AboutController::class, 'index'])->name('about.index');
        Route::post('/about', [App\Http\Controllers\Admin\AboutController::class, 'update'])->name('about.update');

        // Logo
        Route::get('/logo', [App\Http\Controllers\Admin\LogoController::class, 'index'])->name('logo.index');
        Route::post('/logo', [App\Http\Controllers\Admin\LogoController::class, 'update'])->name('logo.update');
        Route::delete('/logo', [App\Http\Controllers\Admin\LogoController::class, 'destroy'])->name('logo.destroy');

        // Settings (stats, footer, social, whatsapp, contact form)
        Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');

        // Contact submissions
        Route::get('/contacts', [App\Http\Controllers\Admin\ContactSubmissionController::class, 'index'])->name('contacts.index');
        Route::delete('/contacts/{id}', [App\Http\Controllers\Admin\ContactSubmissionController::class, 'destroy'])->name('contacts.destroy');
        Route::patch('/contacts/{id}/read', [App\Http\Controllers\Admin\ContactSubmissionController::class, 'markAsRead'])->name('contacts.read');

        // Services CRUD
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);

        // Testimonials CRUD
        Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);

        // Client Logos
        Route::get('/client-logos', [App\Http\Controllers\Admin\ClientLogoController::class, 'index'])->name('client-logos.index');
        Route::post('/client-logos', [App\Http\Controllers\Admin\ClientLogoController::class, 'store'])->name('client-logos.store');
        Route::delete('/client-logos/{id}', [App\Http\Controllers\Admin\ClientLogoController::class, 'destroy'])->name('client-logos.destroy');

        // Insights
        Route::get('/insights', [App\Http\Controllers\Admin\InsightController::class, 'index'])->name('insights.index');
        Route::post('/insights', [App\Http\Controllers\Admin\InsightController::class, 'store'])->name('insights.store');
        Route::put('/insights/{id}', [App\Http\Controllers\Admin\InsightController::class, 'update'])->name('insights.update');
        Route::delete('/insights/{id}', [App\Http\Controllers\Admin\InsightController::class, 'destroy'])->name('insights.destroy');
    });
});
