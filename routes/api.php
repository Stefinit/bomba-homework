<?php

use App\Http\Controllers\OrderController;
use App\Jobs\UpdateOrderStatusJob;
use Illuminate\Support\Facades\Route;


Route::prefix('orders')->group(function () {
    Route::get('test', function () {
        dispatch(new UpdateOrderStatusJob());
    });

    Route::get('/', [OrderController::class, 'all']);
    Route::get('/{order}', [OrderController::class, 'show']);
    Route::post('/', [OrderController::class, 'store']);

});
