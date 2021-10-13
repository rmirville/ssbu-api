<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Api\Controllers\StageClassificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
  'prefix' => 'v1/stages',
  'namespace' => 'App\Http\Api\Controllers',
], function () {
  Route::get('/classifications', [StageClassificationController::class, 'index']);
  Route::get('/{classification}/classifications', [StageClassificationController::class, 'show']);
  Route::resource('piece-maps', 'StagePieceMapController')->only(['index', 'show']);
});
