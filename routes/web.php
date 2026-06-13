<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\StorePageController;

Route::redirect('/', '/stores');

// Temporary debug route - remove after fixing
Route::get('/debug-check', function () {
    try {
        $manifestPath = public_path('build/manifest.json');
        $manifestExists = file_exists($manifestPath);
        $buildDirExists = is_dir(public_path('build'));
        $buildDirContents = $buildDirExists ? scandir(public_path('build')) : [];
        
        // Try to render stores view
        $stores = \App\Models\Store::with('coupons')->get();
        
        return response()->json([
            'status' => 'ok',
            'php_version' => PHP_VERSION,
            'manifest_exists' => $manifestExists,
            'build_dir_exists' => $buildDirExists,
            'build_dir_contents' => $buildDirContents,
            'stores_count' => $stores->count(),
            'public_path' => public_path(),
            'base_path' => base_path(),
            'app_env' => config('app.env'),
            'db_connection' => config('database.default'),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => collect($e->getTrace())->take(5)->toArray(),
        ], 500);
    }
});

Route::get('/stores', [StorePageController::class, 'index']);
Route::get('/stores/{id}', [StorePageController::class, 'show']);