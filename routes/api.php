<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrainingCenterController;
use Illuminate\Support\Facades\Route;

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

// Todos los endpoints API devuelven JSON, incluidos los alias heredados.
Route::middleware('api.json')->group(function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Endpoints GET para consultar registros desde clientes externos.
    Route::get('areas', [AreaController::class, 'index']);
    Route::get('training-centers', [TrainingCenterController::class, 'index']);
    Route::get('computers', [ComputerController::class, 'index']);
    Route::get('teachers', [TeacherController::class, 'index']);
    Route::get('courses', [CourseController::class, 'index']);
    Route::get('apprentices', [ApprenticeController::class, 'index']);
    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('galleries', [GalleryController::class, 'index']);

    // Endpoints POST para crear registros desde clientes externos.
    Route::post('areas', [AreaController::class, 'store']);
    Route::post('training-centers', [TrainingCenterController::class, 'store']);
    Route::post('computers', [ComputerController::class, 'store']);
    Route::post('teachers', [TeacherController::class, 'store']);
    Route::post('courses', [CourseController::class, 'store']);
    Route::post('apprentices', [ApprenticeController::class, 'store']);
    Route::post('contacts', [ContactController::class, 'store']);
    Route::post('galleries', [GalleryController::class, 'store']);
});

// API versionada principal. El middleware garantiza JSON aunque Postman no envíe Accept.
Route::prefix('v1')->middleware('api.json')->group(function () {
    Route::get('areas', [AreaController::class, 'index']);
    Route::get('training-centers', [TrainingCenterController::class, 'index']);
    Route::get('computers', [ComputerController::class, 'index']);
    Route::get('teachers', [TeacherController::class, 'index']);
    Route::get('courses', [CourseController::class, 'index']);
    Route::get('apprentices', [ApprenticeController::class, 'index']);
    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('galleries', [GalleryController::class, 'index']);

    Route::post('areas', [AreaController::class, 'store']);
    Route::post('training-centers', [TrainingCenterController::class, 'store']);
    Route::post('computers', [ComputerController::class, 'store']);
    Route::post('teachers', [TeacherController::class, 'store']);
    Route::post('courses', [CourseController::class, 'store']);
    Route::post('apprentices', [ApprenticeController::class, 'store']);
    Route::post('contacts', [ContactController::class, 'store']);
    Route::post('galleries', [GalleryController::class, 'store']);
});

// Alias temporal para conservar compatibilidad con clientes que usan /api/v1/catalog.
Route::prefix('v1/catalog')->middleware('api.json')->group(function () {
    Route::get('areas', [AreaController::class, 'index']);
    Route::get('training-centers', [TrainingCenterController::class, 'index']);
    Route::get('computers', [ComputerController::class, 'index']);
    Route::get('teachers', [TeacherController::class, 'index']);
    Route::get('courses', [CourseController::class, 'index']);
    Route::get('apprentices', [ApprenticeController::class, 'index']);
    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('galleries', [GalleryController::class, 'index']);
});
