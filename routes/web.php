<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AvailableSurveys;
use App\Http\Controllers\SurveyController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/surveys', AvailableSurveys::class)->name('surveys');
Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');

// Route::get('/surveys/{survey_id}', [SurveyController::class, 'show'])->name('surveys.show');