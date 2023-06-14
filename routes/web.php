<?php

use App\Http\Controllers\AdministrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/register', [UserController::class, 'RegisterUser']);
Route::post('/api/validate', [UserController::class, 'jwtValidateInRealTime']);
Route::post('/api/login', [UserController::class, 'AuthenticateUser']);
Route::post('/api/dashboard/new/transaction', [AdministrationController::class, 'insertNewTransactionOnAdminPanel']);
Route::post('/api/dashboard/upload/files_private', [AdministrationController::class, 'uploadFile']);
Route::get('/api/dashboard/getAll/transactions/{id}', [AdministrationController::class, 'getValuesByUserId']);
Route::get('/api/dashboard/getAll/files/{id}', [AdministrationController::class, 'getUserFiles']);
Route::get('/api/dashboard/delete/travel/{id}', [AdministrationController::class, 'deleteTravelById']);
Route::get('/api/dashboard/delete/file/{name}/{id}/{username}/{user_id}', [AdministrationController::class, 'deleteFileById']);
