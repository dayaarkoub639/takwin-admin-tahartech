<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorksheetController;
use App\Http\Controllers\TraineeTestController;
use App\Http\Controllers\WorksheetTestController;
use App\Http\Controllers\WorksheetResultController;
use App\Http\Controllers\QrController;




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::post('/questions', [App\Http\Controllers\QuestionController::class, 'store'])->name('questions.store');

// مسارات ورقة العمل
Route::get('/worksheets/create', [WorksheetController::class, 'create'])->name('worksheets.create');
Route::post('/worksheets', [WorksheetController::class, 'store'])->name('worksheets.store');

Route::get('/test/{worksheetId}', [TraineeTestController::class, 'start']);
Route::post('/test/{worksheetId}/next', [TraineeTestController::class, 'next']);
Route::get('/test/{worksheetId}/result/{sessionId}', [TraineeTestController::class, 'result']);

Route::get('/teste', [WorksheetController::class, 'index'])->name('worksheets.index');
Route::get('/worksheets/{uuid}/test', [WorksheetTestController::class, 'show'])->name('worksheets.test.show');
Route::post('/worksheets/{uuid}/test', [WorksheetTestController::class, 'store'])->name('worksheets.test.store');
Route::get('/results/{uuid}', [WorksheetResultController::class, 'show'])->name('results.show');

Route::delete('/worksheets/{worksheet}', [WorksheetController::class, 'destroy'])->name('worksheets.destroy');

Route::get('/show-qr', [QrController::class, 'showQr'])->name('show.qr');

Route::patch('/worksheets/{worksheet}/toggle', [WorksheetController::class, 'toggle'])->name('worksheets.toggle');

Route::get('/worksheets/{id}/results', [App\Http\Controllers\WorksheetController::class, 'showResults'])->name('worksheets.results');




