<?php

use App\Http\Controllers\TicketsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/tickets', [TicketsController::class, 'find']);
Route::post('/tickets', [TicketsController::class, 'save']);
Route::get('/tickets/pagination', [TicketsController::class, 'paginate']);
Route::put('/tickets/{ticket_id}', [TicketsController::class, 'update']);
Route::get('/tickets/{ticket_id}', [TicketsController::class, 'find_byId']);
Route::delete('/tickets/{ticket_id}', [TicketsController::class, 'delete']);
