<?php

use Illuminate\Support\Facades\Route;

Route::prefix('statistics')->group(function () {
    Route::get('/investigators','InvestigatorController@index');
});

