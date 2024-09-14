<?php

use App\Models\User;
use App\Models\Attendance;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Departmentassignment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaverequestController;
use App\Http\Controllers\DepartmentassignmentController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::post('/pegawai', [PegawaiController::class, 'store']);
Route::put('/pegawai/{id}', [PegawaiController::class, 'update']);
Route::get('/pegawai/{id}', [PegawaiController::class, 'show']);
Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy']);


// Deparment
Route::get('/department', [DepartmentController::class, 'index']);
Route::post('/department', [DepartmentController::class, 'store']);
Route::put('/department/{id}', [DepartmentController::class, 'update']);
Route::get('/department/{id}', [DepartmentController::class, 'show']);
Route::delete('/department/{id}', [DepartmentController::class, 'destroy']);

Route::get('/penugasan', [DepartmentassignmentController::class, 'index']);
Route::post('/penugasan', [DepartmentassignmentController::class, 'store']);
Route::get('/penugasan/{id}', [DepartmentassignmentController::class, 'show']);
Route::put('/penugasan/{id}', [DepartmentassignmentController::class, 'update']);

Route::get('/absensi', [AttendanceController::class, 'index']);
Route::post('/absensi', [AttendanceController::class, 'store']);

Route::get('/leave-request', [LeaverequestController::class, 'index']);
Route::post('/leave-request/terima/{id}', [LeaverequestController::class, 'terima']);
Route::post('/leave-request/tolak/{id}', [LeaverequestController::class, 'tolak']);


