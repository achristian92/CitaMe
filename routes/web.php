<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/especialidades', [App\Http\Controllers\admin\SpecialtyController::class, 'index']);

    Route::get('/especialidades/create', [App\Http\Controllers\admin\SpecialtyController::class, 'create']);
    Route::get('/especialidades/{specialty}/edit', [App\Http\Controllers\admin\SpecialtyController::class, 'edit']);
    Route::post('/especialidades', [App\Http\Controllers\admin\SpecialtyController::class, 'sendData']);

    Route::put('/especialidades/{specialty}', [App\Http\Controllers\admin\SpecialtyController::class, 'update']);
    Route::delete('/especialidades/{specialty}', [App\Http\Controllers\admin\SpecialtyController::class, 'destroy']);

    //Rutas de Medicos
    Route::resource('medicos','App\Http\Controllers\admin\DoctorController');

    //Rutas de Pacientes
    Route::resource('pacientes','App\Http\Controllers\admin\PatientController');
});


//Rutas de Medicos
Route::middleware(['auth', 'doctor'])->group(function ()
{
    Route::get('/horario', [App\Http\Controllers\doctor\HorarioController::class, 'edit']);
    Route::post('/horario', [App\Http\Controllers\doctor\HorarioController::class, 'store']);
});

//Rutas de Pacientes
Route::get('/reservarcitas/create', [App\Http\Controllers\AppointmentController::class, 'create']);
Route::get('/miscitas', [App\Http\Controllers\AppointmentController::class, 'store']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


