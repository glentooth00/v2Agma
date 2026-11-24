
<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'application' => 'AGMA ONE',
        'service' => 'API',
        'message' => 'AGMA ONE API is running.',
    ]);
});
