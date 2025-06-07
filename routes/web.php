<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AvailableSurveys;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/surveys', AvailableSurveys::class)->name('surveys');
