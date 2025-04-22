<?php

use App\Http\Controllers\CsvUploadController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::post('/upload-csv', [CsvUploadController::class, 'upload']);
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/truncate-employees', [EmployeeController::class, 'truncateEmployees']);