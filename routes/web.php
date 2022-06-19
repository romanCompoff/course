<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\LCourseController::class, 'homePage']);

Route::get('/111', 'CourseController@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shedule', [App\Http\Controllers\SheduleController::class, 'index'])->name('shedule');

Route::middleware(['role:user'])->prefix('courses')->group( function () {
    Route::get('/{id}', [App\Http\Controllers\LCourseController::class, 'oneCourse'])->name('one-course');
    Route::get('/course/{id}', [App\Http\Controllers\LCourseController::class, 'courseInCathegory'])->name('courseInCathegory');
});
Route::middleware(['role:user'])->prefix('user')->group( function () {
    Route::get('/passport/{id}', [App\Http\Controllers\StudentController::class, 'passport'])->name('passport');
    Route::post('/add-student', [App\Http\Controllers\StudentController::class, 'checkAndAdd'])->name('add-student');
    Route::post('/buy', [App\Http\Controllers\StudentController::class, 'studyBuy'])->name('study.buy');
    Route::post('/pay', [App\Http\Controllers\StudentController::class, 'studyPay'])->name('study.pay');
    Route::get('/tests', [App\Http\Controllers\LCourseController::class, 'tests'])->name('tests');
    Route::get('/courses', [App\Http\Controllers\LCourseController::class, 'courses'])->name('courses');
    Route::get('/allcourses', [App\Http\Controllers\LCourseController::class, 'allcourses'])->name('allcourses');
});
Route::middleware(['role:student'])->prefix('study')->group( function () {
    Route::get('/course/{id}', [App\Http\Controllers\StudentController::class, 'oneCourse'])->name('study.course');
});
Route::middleware(['role:teacher'])->prefix('administrator')->group( function () {
    Route::resource('courses',  LCourseController::Class);
    Route::resource('matherials',  MatherialController::Class);
});
Route::middleware(['role:admin'])->prefix('administrator')->group( function () {
   Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('administrator');
   Route::get('/teacher', [App\Http\Controllers\Admin\TeacherController::class, 'index'])->name('teacher');
   Route::get('/teacher/create/{id}', [App\Http\Controllers\Admin\TeacherController::class, 'create'])->name('teacher.create');
   Route::get('/teacher/{id}/edit', [App\Http\Controllers\Admin\TeacherController::class, 'edit'])->name('teacher.edit');
   Route::get('/teacher/update/', [App\Http\Controllers\Admin\TeacherController::class, 'update'])->name('teacher.update');
});
