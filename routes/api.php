<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaccineAPIController;
use App\Http\Controllers\StudentAPIController;
use App\Http\Controllers\FacultyAPIController;
use App\Http\Controllers\ProgramAPIController;
use App\Http\Controllers\VaccineRecordAPIController;
use Spatie\FlareClient\API;

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
// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/vaccine', [VaccineAPIController::class, 'index']);
Route::get('/vaccine/{id}', [VaccineAPIController::class, 'show']);
Route::get('/vaccine/search/{name}', [VaccineAPIController::class,'search']);

Route::get('/student', [StudentAPIController::class, 'index']);
Route::get('/student/{id}', [StudentAPIController::class, 'show']);
Route::get('/student/search/{name}', [StudentAPIController::class,'search']);


Route::get('/faculty', [FacultyAPIController::class, 'index']);
Route::get('/faculty/{id}', [FacultyAPIController::class, 'show']);
Route::get('/faculty/search/{name}', [FacultyAPIController::class,'search']);


Route::get('/program', [ProgramAPIController::class, 'index']);
Route::get('/program/{id}', [ProgramAPIController::class, 'show']);
Route::get('/program/search/{name}', [ProgramAPIController::class,'search']);


Route::get('/vaccinerecord', [VaccineRecordAPIController::class, 'index']);
Route::get('/vaccinerecord/{id}', [VaccineRecordAPIController::class, 'show']);
Route::get('/vaccinerecord/search/{name}', [VaccineRecordAPIController::class,'search']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
Route::post('/vaccine', [VaccineAPIController::class, 'store']);
Route::put('/vaccine/{id}', [VaccineAPIController::class, 'update']);
Route::delete('/vaccine/{id}', [VaccineAPIController::class, 'destroy']);

Route::post('/student', [StudentAPIController::class, 'store']);
Route::put('/student/{id}', [StudentAPIController::class, 'update']);
Route::delete('/student/{id}', [StudentAPIController::class, 'destroy']);

Route::post('/faculty', [FacultyAPIController::class, 'store']);
Route::put('/faculty/{id}', [FacultyAPIController::class, 'update']);
Route::delete('/faculty/{id}', [FacultyAPIController::class, 'destroy']);

Route::post('/program', [ProgramAPIController::class, 'store']);
Route::put('/program/{id}', [ProgramAPIController::class, 'update']);
Route::delete('/program/{id}', [ProgramAPIController::class, 'destroy']);

Route::post('/vaccinerecord', [VaccineRecordAPIController::class, 'store']);
Route::put('/vaccinerecord/{id}', [VaccineRecordAPIController::class, 'update']);
Route::delete('/vaccinerecord/{id}', [VaccineRecordAPIController::class, 'destroy']);

Route::post('/logout', [AuthController::class, 'logout']);

});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// API routes

