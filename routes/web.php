<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\ScheduleController;
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


//  FUNGSI GET NOMOR ANTRIAN ADA DI FOTO
// Todo ====================================================================
// Input jadwal dokter tidak bisa pada hari yang sama					====
// Pasien register dengan nik sama langsung login						====
// =========================================================================

// laravel add multiple tag with drop down
// https://www.youtube.com/watch?v=fkJvgcwrVlQ
// https://fontawesome.com/v4/icon/
// https://icons.getbootstrap.com/
// https://adminlte.io/themes/v3/index3.html
// add search obat
// https://youtu.be/6XGwgfUJYXc?list=PLlyXGimlMbeaBcuNBV_euGZSkbiRqsny9&t=355
// https://www.youtube.com/watch?v=lYV9XYs3pBM
// Gemini code explain code

// Middleware Admin
Route::group(['middleware' => 'admin'], function(){
    Route::resource('/drugs', DrugController::class);
});

// Middleware Doctor
Route::group(['middleware' => 'doctor'], function(){
    Route::get('/doctor_dashboard', function () {
        return view('doctor_dashboard');
    });
    Route::resource('/schedules', ScheduleController::class);
});

// Middleware Patient
Route::group(['middleware' => 'patient'], function(){
    Route::get('/patient_dashboard', function () {
        return view('patient_dashboard');
    });
});

// Login and Logout
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);
