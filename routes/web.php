<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DrugController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'admin'], function(){
    Route::get('/admin_dashboard', function () {
        return view('admin_dashboard');
    });
    Route::resource('/drugs', DrugController::class);
});
Route::group(['middleware' => 'patient'], function(){
    Route::get('/patient_dashboard', function () {
        return view('patient_dashboard');
    });
});
Route::group(['middleware' => 'doctor'], function(){
    Route::get('/doctor_dashboard', function () {
        return view('doctor_dashboard');
    });
});



Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    return view('login');
});



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);
