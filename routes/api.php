<?php

use App\Http\Controllers\Api\V1\Admin\CashflowApiController;
use App\Http\Controllers\Api\V1\Admin\PiutangApiController;
use App\Http\Controllers\Api\V1\Admin\SetoranApiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Piutang
    Route::apiResource('piutangs', PiutangApiController::class);

    // Setoran
    Route::apiResource('setorans', SetoranApiController::class);

    // Cashflow
    Route::apiResource('cashflows', CashflowApiController::class);
});
