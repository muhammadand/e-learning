<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenggunaController;

use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CplController;
use App\Http\Controllers\CpmkController;
use App\Http\Controllers\CourseContentController;

use App\Http\Controllers\CplCpmkController;
use App\Http\Controllers\CourseCplController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RpsController; 
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\CourseFeedbackController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuizAnswerController;

Route::prefix('cpmk/{cpmk_id}')->group(function () {
    Route::get('quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('quizzes', [QuizController::class, 'store'])->name('quizzes.store');
});
Route::get('/quizzes/report/{quiz_id}', [QuizController::class, 'report'])->name('quiz.report');
Route::get('/quizzes/report/detail/{attempt_id}', [QuizController::class, 'detailReport'])->name('quiz.detail');
Route::get('/quiz/{quiz_id}/detail/{user_id}', [QuizController::class, 'detail'])->name('quiz.detail');


Route::get('/cpmk/{cpmkId}/quizzes', [CourseController::class, 'getQuizzes']);

Route::prefix('quiz/{quiz_id}')->group(function () {
    Route::get('questions', [QuizQuestionController::class, 'index'])->name('questions.index');
    Route::get('questions/create', [QuizQuestionController::class, 'create'])->name('questions.create');
    Route::post('questions', [QuizQuestionController::class, 'store'])->name('questions.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/quizzes/{quiz_id}/start', [QuizAttemptController::class, 'start'])->name('quizzes.start');
    Route::post('/quizzes/attempt', [QuizAttemptController::class, 'store'])->name('quizzes.attempt.store');
});
Route::get('/quiz/completed', function () {
    return view('quizzes.completed');
})->name('quiz.completed');


Route::post('answers/store', [QuizAnswerController::class, 'store'])->name('answers.store');




Route::middleware(['auth'])->group(function () {
    Route::get('/courses/{id}/feedback', [CourseFeedbackController::class, 'index'])->name('feedback.index');

    Route::post('/feedback/store', [CourseFeedbackController::class, 'store'])->name('feedback.store');
});

Route::get('/', [PenggunaController::class, 'index'])->name('home');

Route::get('/cpmk/{cpmkId}/materials', [MaterialController::class, 'getMaterials']);

Route::post('/progress/complete/{materialId}', [ProgressController::class, 'complete'])->name('progress.complete');
Route::get('/progress/status/{courseId}', [ProgressController::class, 'getProgress'])->name('progress.status');

Route::get('/rps', [RpsController::class, 'index'])->name('rps.index')->middleware('auth');
Route::get('/rps/{course}', [RpsController::class, 'show'])->name('rps.show');

Route::get('/cpmk/{id}/materials', [CpmkController::class, 'getMaterials']);


Route::get('/materials/index', [MaterialController::class, 'index'])->name('materials.index'); // Menampilkan daftar materi
Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create'); // Form tambah materi
Route::post('/materials/store', [MaterialController::class, 'store'])->name('materials.store'); // Simpan materi baru
Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('materials.show'); // Detail materi
Route::get('/materials/{id}/edit', [MaterialController::class, 'edit'])->name('materials.edit'); // Form edit materi
Route::put('/materials/{id}', [MaterialController::class, 'update'])->name('materials.update'); // Update materi
Route::delete('/materials/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy'); // Hapus materi


Route::resource('cpl_cpmk', CplCpmkController::class)->only(['index', 'create', 'store']);
Route::resource('course_cpl', CourseCplController::class)->only(['index', 'create', 'store']);


Route::prefix('courses/{course}/contents')->group(function () {
    Route::get('/', [CourseContentController::class, 'index'])->name('course_contents.index');
    Route::get('/create', [CourseContentController::class, 'create'])->name('course_contents.create');
    Route::post('/store', [CourseContentController::class, 'store'])->name('course_contents.store');
    Route::delete('/{id}', [CourseContentController::class, 'destroy'])->name('course_contents.destroy');
});
Route::get('/courses/enrol', [CourseController::class, 'enrol'])->name('courses.enrol');
Route::get('/courses/startlearning/{id}', [CourseController::class, 'startleaning'])->name('courses.start'); 
Route::resource('courses', CourseController::class);
Route::resource('cpls', CplController::class);
Route::post('/cpls/store-multiple', [CplController::class, 'storeMultiple'])->name('cpls.store.multiple');

Route::resource('cpmks', CpmkController::class);


Route::resource('study_programs', StudyProgramController::class);


Route::resource('faculties', FacultyController::class);


Route::resource('users', UserController::class);

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard setelah login
Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('auth')
    ->name('admin.dashboard');

// Route::get('/course/start/{id}', [CourseController::class, 'startLearning'])->name('course.start')->middleware('auth');






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



// /// Menampilkan daftar user
// Route::get('users', [UserController::class, 'index'])->name('user.index');

// // Menampilkan form edit user
// Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');

// // Update user
// Route::put('users/{id}', [UserController::class, 'update'])->name('user.update');

// // Hapus user
// Route::delete('users/{id}', [UserController::class, 'destroy'])->name('user.destroy');


// Route::get('/', [UserController::class, 'login'])->name('login');
// Route::get('register', [UserController::class, 'register'])->name('register');
// Route::post('register', [UserController::class, 'register_action'])->name('register.action');
// Route::post('login', [UserController::class, 'login_action'])->name('login.action');
// Route::get('password', [UserController::class, 'password'])->name('password');
// Route::post('password', [UserController::class, 'password_action'])->name('password.action');
// Route::get('logout', [UserController::class, 'logout'])->name('logout');





// Routes untuk admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
// Routes untuk user
Route::get('/landing', [PenggunaController::class, 'index'])->name('pengguna.index');


use App\Http\Controllers\ProfilController;

Route::get('profile', [ProfilController::class, 'show'])->name('profile.show');

// Route untuk menampilkan form create profil
Route::get('/profil/create', [ProfilController::class, 'create'])->name('profil.create');



// Route untuk menyimpan data profil
Route::post('/profil', [ProfilController::class, 'store'])->name('profil.store');
// Route untuk menampilkan form edit profil
Route::get('/profil/edit/{id}', [ProfilController::class, 'edit'])->name('profil.edit');
// Route untuk mengupdate profil
Route::put('/profil/update/{id}', [ProfilController::class, 'update'])->name('profil.update');

