<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Professors
Route::get('professor/{professor}', [\App\Http\Controllers\ProfessorController::class, 'show'])->name('professor.get');
Route::get('professors', [\App\Http\Controllers\ProfessorController::class, 'index'])->name('professor.index');
Route::middleware('auth')->group(function () {
    Route::get('professors/add', [\App\Http\Controllers\ProfessorController::class, 'create'])->name('professor.create');
    Route::post('professors', [\App\Http\Controllers\ProfessorController::class, 'store'])->name('professor.store');

    // Comments
    Route::get('comments', [\App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
    Route::post('comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
    Route::delete('comments', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.delete');
});

Route::get('contacts', function () {

    return Inertia('Contacts');
});

// Schools
Route::get('schools', [\App\Http\Controllers\SchoolController::class, 'index'])->name('school.index');
