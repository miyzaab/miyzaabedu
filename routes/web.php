<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Dashboard Route
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Protected Audio Actions
    Route::get('/audio/play/{audio}', [App\Http\Controllers\AudioLearningController::class, 'play'])
        ->name('audio.play')
        ->middleware(App\Http\Middleware\CheckAudioProgress::class);
    Route::post('/audio/progress/{audio}', [App\Http\Controllers\AudioLearningController::class, 'updateProgress'])->name('audio.update-progress');

    // Protected Video Actions
    Route::post('/videos/{video}/complete', [App\Http\Controllers\VideoController::class, 'markAsCompleted'])->name('videos.complete');
});

// Public Audio Learning - 3 Level Structure
Route::get('/audio-learning', [App\Http\Controllers\AudioLearningController::class, 'index'])->name('audio.index');
Route::get('/audio-learning/marhalah/{level}', [App\Http\Controllers\AudioLearningController::class, 'marhalah'])->name('audio.marhalah');
Route::get('/audio-learning/{slug}', [App\Http\Controllers\AudioLearningController::class, 'show'])->name('audio.show');

// Public Quiz
Route::get('/quiz', [App\Http\Controllers\QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/{quiz}', [App\Http\Controllers\QuizController::class, 'show'])->name('quiz.show');

// Public Articles
Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

// Public Videos
Route::get('/videos', [App\Http\Controllers\VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/{slug}', [App\Http\Controllers\VideoController::class, 'show'])->name('videos.show');

// Google Auth
Route::get('/auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);

require __DIR__ . '/auth.php';
