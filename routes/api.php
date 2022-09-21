<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\API\GameController;

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

Route::get('/start-game', [GameController::class, 'startGame']);
/**
 * TODO: REMOVE THIS ROUTE
 */
Route::get('/game', [GameController::class, 'test']);

Route::post('/set-player-names', [GameController::class, 'setPlayerNames']);
Route::post('/guess-number', [GameController::class, 'guessNumber']);
