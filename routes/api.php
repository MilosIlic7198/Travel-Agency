<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\InsurancePolicyController;
use App\Http\Controllers\ParticipantController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authenticated', function (Request $request) {
    return true;
});

/* Route::post('/login', [PersonController::class, 'login']);
Route::post('/register', [PersonController::class, 'register']);
Route::post('/logout', [PersonController::class, 'logout']);
Route::get('/people', [PersonController::class, 'get_All_People']);
Route::get('/get-person/{id}', [PersonController::class, 'get_Person']);
Route::post('/edit-person/{id}', [PersonController::class, 'edit_Person']);
Route::delete('/delete-person/{id}', [PersonController::class, 'delete_Person']);

Route::get('/get-all-blogs', [BlogController::class, 'get_All_Blogs']);
Route::get('/get-blogs', [BlogController::class, 'get_Persons_Blogs']);
Route::post('/create-blog', [BlogController::class, 'create_Blog']);
Route::get('/get-blog/{id}', [BlogController::class, 'get_Blog']);
Route::post('/edit-blog/{id}', [BlogController::class, 'edit_Blog']);
Route::delete('/delete-blog/{id}', [BlogController::class, 'delete_Blog']);
Route::put('/publish-blog/{id}', [BlogController::class, 'publish_Blog']);
Route::put('/archive-blog/{id}', [BlogController::class, 'archive_Blog']);

Route::post('/buy-policy', [InsurancePolicyController::class, 'create_Policy']);
Route::get('/get-all-policies', [InsurancePolicyController::class, 'get_All_Policies']);
Route::delete('/delete-policy/{id}', [InsurancePolicyController::class, 'delete_Policy']);

Route::get('/get-all-participants/{id}', [ParticipantController::class, 'get_All_Participants']);
 */