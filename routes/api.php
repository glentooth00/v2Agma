
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScannerAuthController;
use App\Http\Middleware\EnsureScannerIsActive;

/*
|--------------------------------------------------------------------------
| AGMA ONE API Routes
|--------------------------------------------------------------------------
*/

// API Health Check
Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'application' => 'AGMA ONE',
        'service' => 'API',
        'message' => 'AGMA ONE API is running.',
    ]);
});

// Scanner Authentication
Route::prefix('scanner')->group(function () {

    // Scanner Login
    Route::post('/login', [
        ScannerAuthController::class,
        'login',
    ])->name('api.scanner.login');

    // Authenticated Scanner Routes
    Route::middleware([
        'auth:sanctum',
        EnsureScannerIsActive::class,
    ])->group(function () {

        // Get authenticated scanner details
        Route::get('/me', [
            ScannerAuthController::class,
            'me',
        ])->name('api.scanner.me');

        // Scanner Logout
        Route::post('/logout', [
            ScannerAuthController::class,
            'logout',
        ])->name('api.scanner.logout');

    });

});
