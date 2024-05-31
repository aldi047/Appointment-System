<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\ExaminationController;
use App\Models\RegPolyclinic;
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

// View
Route::get('/', function () {
    return view('welcome', ['registration' => RegPolyclinic::count()]);
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('examinations', [ExaminationController::class, 'examinations']);
Route::get('history', [ExaminationController::class, 'history']);
// laravel add multiple tag with drop down
// add search obat


// Middleware Admin
Route::group(['middleware' => 'admin'], function(){
    Route::resource('/drugs', DrugController::class);
});

// Middleware Patient
Route::group(['middleware' => 'patient'], function(){
    Route::get('/patient_dashboard', function () {
        return view('patient_dashboard');
    });
});

// Middleware Doctor
Route::group(['middleware' => 'doctor'], function(){
    Route::get('/doctor_dashboard', function () {
        return view('doctor_dashboard');
    });
});


// Login and Logout
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);
