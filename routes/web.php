<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\RegPolyclinicController;
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



//  FUNGSI GET NOMOR ANTRIAN ADA DI FOTO
// Todo ====================================================================
// Input jadwal dokter tidak bisa pada hari yang sama	(Done)			====
// Edit jadwal dokter tidak bisa pada hari yang sama + jangan tabrakan  ====
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
    Route::resource('/doctors', DoctorController::class);
});

// Middleware Doctor
Route::group(['middleware' => 'doctor'], function(){
    Route::resource('/schedules', ScheduleController::class);
    Route::get('examinations', [ExaminationController::class, 'examinations']);
    Route::get('history', [ExaminationController::class, 'history']);
});

// Middleware Patient
Route::group(['middleware' => 'patient'], function(){
    Route::get('/reg-polyclinic', [RegPolyclinicController::class, 'index']);
    Route::post('/reg-polyclinic', [RegPolyclinicController::class, 'store'])->name('reg-poly');
    Route::get('/reg-polyclinic/detail-history/{history}', [RegPolyclinicController::class, 'detail'])->name('detail');
});

// Login and Logout
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

// API
Route::get('/list_polyclinic', [PolyclinicController::class, 'getPolyclinic']);
Route::get('/getSchedule/{id}', [RegPolyclinicController::class, 'getSchedule']);
