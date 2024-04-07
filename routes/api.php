<?php

use App\Http\Controllers\BooksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('submit-read',[BooksController::class, 'SubmitReading']);
Route::get('top-read-books',[BooksController::class, 'TopReadBooks']);
