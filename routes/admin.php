<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AudioController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserProgressController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::delete('audio/bulk-destroy', [AudioController::class, 'bulkDestroy'])->name('audio.bulk-destroy');
    Route::resource('audio', AudioController::class);
    Route::delete('videos/bulk-destroy', [VideoController::class, 'bulkDestroy'])->name('videos.bulk-destroy');
    Route::resource('videos', VideoController::class);
    Route::delete('articles/bulk-destroy', [ArticleController::class, 'bulkDestroy'])->name('articles.bulk-destroy');
    Route::resource('articles', ArticleController::class);
    Route::delete('quizzes/bulk-destroy', [QuizController::class, 'bulkDestroy'])->name('quizzes.bulk-destroy');
    Route::resource('quizzes', QuizController::class);
    Route::post('quizzes/{quiz}/questions', [QuizController::class, 'addQuestion'])->name('quizzes.addQuestion');
    Route::delete('quizzes/{quiz}/questions/{question}', [QuizController::class, 'deleteQuestion'])->name('quizzes.deleteQuestion');
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/move-up', [CategoryController::class, 'moveUp'])->name('categories.move-up');
    Route::post('categories/{category}/move-down', [CategoryController::class, 'moveDown'])->name('categories.move-down');

    // User Progress (Quiz Scores)
    Route::resource('progress', UserProgressController::class)->only(['index', 'show']);

    // Super Admin Only
    Route::middleware('super_admin')->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });
});
