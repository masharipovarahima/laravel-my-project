<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\FileController;

Route::post('/files/upload', [FileController::class, 'upload']); // Fayl yuklash
Route::get('/files', [FileController::class, 'index']); // Barcha fayllarni olish
Route::get('/files/{id}', [FileController::class, 'show']); // Bitta faylni olish
Route::get('/files/download/{id}', [FileController::class, 'download']); // Fayl yuklab olish
Route::post('/files/update/{id}', [FileController::class, 'update']); // Faylni yangilash
Route::delete('/files/delete/{id}', [FileController::class, 'delete']); // Faylni o‘chirish
