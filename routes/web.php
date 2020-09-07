<?php

use Illuminate\Support\Facades\Route;

Route::prefix('statistics')->group(function () {
    Route::get('/investigators','InvestigatorController@index');
    Route::get('/investigators/interest','InvestigatorController@interest');
});

Route::get('', function () {
    return view('layouts.app');
});

Route::get('home', function () {
    return view('layouts.app');
});

Route::get('researcher', function () {
    return view('layouts.app');
});

Route::get('research', function () {
    return view('layouts.app');
});

