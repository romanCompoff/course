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
});
Route::middleware(['role:user'])->prefix('user')->group( function () {
    Route::get('/passport', [App\Http\Controllers\StudentController::class, 'passport'])->name('passport');
});
Route::middleware(['role:student'])->prefix('study')->group( function () {

});
Route::middleware(['role:teacher'])->prefix('administrator')->group( function () {
    Route::resource('courses',  LCourseController::Class);
});
Route::middleware(['role:admin'])->prefix('administrator')->group( function () {
   Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);
   Route::get('/teacher', [App\Http\Controllers\Admin\TeacherController::class, 'index'])->name('teacher');
   Route::get('/teacher/create/{id}', [App\Http\Controllers\Admin\TeacherController::class, 'create'])->name('teacher.create');
   Route::get('/teacher/{id}/edit', [App\Http\Controllers\Admin\TeacherController::class, 'edit'])->name('teacher.edit');
   Route::get('/teacher/update/', [App\Http\Controllers\Admin\TeacherController::class, 'update'])->name('teacher.update');
});
