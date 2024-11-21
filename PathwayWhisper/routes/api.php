<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shared\Postscontroller;
use App\Http\Controllers\Shared\Authcontroller;
use App\Http\Controllers\Mentor\LivestreamController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [Postscontroller::class, 'fetch_posts']);

// api/getmentor/info/{id}
Route::get('/getmentor/info/{id}', [Authcontroller::class, 'getmentorinfo']);

// create a live stream
Route::post('/create/livestream', [LivestreamController::class, 'create_livestream']);




