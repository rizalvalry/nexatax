<?php

use Illuminate\Support\Facades\Route;

// Diagnostic — hapus setelah debug selesai
Route::get('/check-assets', function () {
    $r = [];
    $r['APP_URL'] = config('app.url');
    $r['public_path'] = public_path();
    $r['storage_link_exists'] = file_exists(public_path('storage')) ? 'YES' : 'NO';
    $r['storage_is_dir'] = is_dir(public_path('storage')) ? 'YES' : 'NO';
    $r['storage_app_public'] = is_dir(storage_path('app/public')) ? 'YES' : 'NO';

    // List files in storage/app/public
    $dir = storage_path('app/public');
    $files = [];
    if (is_dir($dir)) {
        $rii = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
        $i = 0;
        foreach ($rii as $f) {
            if ($f->isFile() && $f->getFilename() !== '.gitignore') {
                $files[] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($dir, '', $f->getPathname()));
                if (++$i >= 30) break;
            }
        }
    }
    $r['uploaded_files'] = $files ?: ['(kosong - belum ada file upload)'];

    // Cek public/assets
    $r['public_assets_exists'] = is_dir(public_path('assets')) ? 'YES' : 'NO';
    if (is_dir(public_path('assets'))) {
        $r['public_assets_files'] = array_values(array_diff(scandir(public_path('assets')), ['.', '..']));
    }

    return response()->json($r, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
});

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
