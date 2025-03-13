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

use App\Http\Controllers\NewsController;

Route::resource('news', NewsController::class);


use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\SeminarController;

// Asosiy sahifa
Route::get('/', function () {
    return view('welcome');
});

// Konferensiyalar uchun marshrutlar
Route::prefix('conferences')->name('conferences.')->group(function () {
    Route::get('/', [ConferenceController::class, 'index'])->name('index'); // Barcha konferensiyalar ro'yxati
    Route::get('/create', [ConferenceController::class, 'create'])->name('create'); // Yangi konferensiya yaratish
    Route::post('/', [ConferenceController::class, 'store'])->name('store'); // Konferensiyani saqlash
    Route::get('/{conference}', [ConferenceController::class, 'show'])->name('show'); // Konferensiya tafsilotlari
    Route::get('/{conference}/edit', [ConferenceController::class, 'edit'])->name('edit'); // Konferensiyani tahrirlash
    Route::put('/{conference}', [ConferenceController::class, 'update'])->name('update'); // Konferensiyani yangilash
    Route::delete('/{conference}', [ConferenceController::class, 'destroy'])->name('destroy'); // Konferensiyani o'chirish
});

// Seminarlar uchun marshrutlar
Route::prefix('seminars')->name('seminars.')->group(function () {
    Route::get('/', [SeminarController::class, 'index'])->name('index'); // Barcha seminarlar ro'yxati
    Route::get('/create', [SeminarController::class, 'create'])->name('create'); // Yangi seminar yaratish
    Route::post('/', [SeminarController::class, 'store'])->name('store'); // Seminarni saqlash
    Route::get('/{seminar}', [SeminarController::class, 'show'])->name('show'); // Seminar tafsilotlari
    Route::get('/{seminar}/edit', [SeminarController::class, 'edit'])->name('edit'); // Seminarni tahrirlash
    Route::put('/{seminar}', [SeminarController::class, 'update'])->name('update'); // Seminarni yangilash
    Route::delete('/{seminar}', [SeminarController::class, 'destroy'])->name('destroy'); // Seminarni o'chirish
});

require __DIR__ . '/auth.php';

use Illuminate\Support\Facades\Log;

Route::get('/test-log', function () {
    Log::error('Test log message!');
    return 'Log yozildi!';
});
