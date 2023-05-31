<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/logs/form/submit', [App\Http\Controllers\TimeLogController::class, 'store'])->name('logs.form.submit');
Route::patch('/logs/form/update', [App\Http\Controllers\TimeLogController::class, 'update'])->name('logs.form.update');
Route::view('Time/Log/Evaluation/form','Time_Log_Evaluation')->name('time.log.evaluation.form');
Route::get('/logs/create/form', [App\Http\Controllers\TimeLogController::class, 'create'])->name('logs.create.form');
Route::get('/logs/display', [App\Http\Controllers\TimeLogController::class, 'index'])->name('logs.display');
Route::get('/Logs/Edit/{id}', [App\Http\Controllers\TimeLogController::class, 'edit'])->name('logs.edit.form');
Route::delete('/Logs/delete/{id}', [App\Http\Controllers\TimeLogController::class, 'destroy'])->name('logs.delete');
Route::get('/Logs/evaluate/', [App\Http\Controllers\TimeLogEvaluationController::class, 'index'])->name('logs.evaluate.submit');
Route::view('Project/create','Create_Project')->name('project.create');
Route::post('/Project/form/submit', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.form.submit');
Route::get('/TimeLog/Export/Csv',[App\Http\Controllers\TimeLogEvaluationController::class, 'exportCSV'])->name('TimeLog.export.csv');
Route::get('/Logs/evaluate/chart', [App\Http\Controllers\TimeLogEvaluationController::class, 'showStatics'])->name('logs.evaluate.submit.chart');
Route::view('TimeLog/Csv','Time_Log_Csv')->name('timelog.csv.form');
Route::get('/Logs/csv/', [App\Http\Controllers\TimeLogController::class, 'ExportToCsv'])->name('timelog.csv.submit');
