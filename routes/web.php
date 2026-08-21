<?php

use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrainingCenterController;
use App\Models\Gallery;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    $databaseGalleries = Gallery::where('is_active', 1)->orderBy('order')->get();

    $folderPath = public_path('imagene/Imagenes SENA');
    $projectImages = collect();

    if (is_dir($folderPath)) {
        $projectImages = collect(glob($folderPath . DIRECTORY_SEPARATOR . '*'))
            ->filter(fn ($file) => is_file($file))
            ->map(function ($file) {
                return (object) [
                    'title' => '',
                    'image_path' => 'imagene/Imagenes SENA/' . basename($file),
                    'description' => '',
                    'order' => 0,
                    'is_active' => true,
                ];
            });
    }

    $galleries = $databaseGalleries->isNotEmpty() ? $databaseGalleries : $projectImages;

    return view('welcome', ['galleries' => $galleries]);
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Contact Routes
Route::resource('contacts', ContactController::class);

// Gallery Routes
Route::resource('galleries', GalleryController::class);

// Areas Routes
Route::get('areas', [AreaController::class, 'index'])->name('areas.index');
Route::get('areas/create', [AreaController::class, 'create'])->name('areas.create');
Route::post('areas', [AreaController::class, 'store'])->name('areas.store');

// Training Centers Routes
Route::get('training-centers', [TrainingCenterController::class, 'index'])->name('training-centers.index');
Route::get('training-centers/create', [TrainingCenterController::class, 'create'])->name('training-centers.create');
Route::post('training-centers', [TrainingCenterController::class, 'store'])->name('training-centers.store');

// Computers Routes
Route::get('computers', [ComputerController::class, 'index'])->name('computers.index');
Route::get('computers/create', [ComputerController::class, 'create'])->name('computers.create');
Route::post('computers', [ComputerController::class, 'store'])->name('computers.store');
Route::delete('computers/{computer}', [ComputerController::class, 'destroy'])->name('computers.destroy');

// Courses Routes
Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('courses', [CourseController::class, 'store'])->name('courses.store');

// Teachers Routes
Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
Route::post('teachers', [TeacherController::class, 'store'])->name('teachers.store');

// Apprentices Routes
Route::get('apprentices', [ApprenticeController::class, 'index'])->name('apprentices.index');
Route::get('apprentices/create', [ApprenticeController::class, 'create'])->name('apprentices.create');
Route::post('apprentices', [ApprenticeController::class, 'store'])->name('apprentices.store');
Route::delete('apprentices/{apprentice}', [ApprenticeController::class, 'destroy'])->name('apprentices.destroy');