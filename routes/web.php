<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');  /// dashboard gaham auth niddlewere qo'ygansiz login qilishi kerak mi bilmayman login qilganimda dashboard ochilar edi qanday ozgartirib yuborganimni tushunmadim



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// use App\Http\Controllers\DashboardController;

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');



Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

use App\Http\Controllers\TeacherController;
Route::resource('teachers', TeacherController::class);
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');



use App\Http\Controllers\ProjectController;
Route::resource('projects', ProjectController::class);


use App\Http\Controllers\ArticleController;
Route::resource('articles', ArticleController::class);

use App\Http\Controllers\DegreeController;
Route::resource('degrees', DegreeController::class);

use App\Http\Controllers\SubjectController;
Route::resource('subjects', SubjectController::class);

use App\Http\Controllers\FileController;

Route::get('/files', [FileController::class, 'index'])->name('files.index');
Route::get('/files/create', [FileController::class, 'create'])->name('files.create');
Route::post('/files/upload', [FileController::class, 'store'])->name('files.store'); // ✅ POST uchun to'g'ri
Route::get('/files/{subject_name}/edit', [FileController::class, 'edit'])->name('files.edit');
Route::put('/files/{id}', [FileController::class, 'update'])->name('files.update');
Route::delete('/files/{id}', [FileController::class, 'destroy'])->name('files.destroy');
Route::get('/files/download/{subject_name}', [FileController::class, 'download'])->name('files.download');


require __DIR__ . '/auth.php';

use Illuminate\Support\Facades\Log;

Route::get('/test-log', function () {
    Log::error('Test log message!');
    return 'Log yozildi!';
});
