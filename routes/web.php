<?php

use Illuminate\Support\Facades\Route;

Route::prefix('statistics')->group(function () {
    Route::get('/investigators','InvestigatorController@index');
    Route::get('/investigators/profile','InvestigatorController@profile');
    Route::get('/investigators/interest','InvestigatorController@interest');
    Route::get('/investigators/current','InvestigatorController@current');
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

Route::get('profileResearch', function () {
    return view('layouts.app');
});

Route::get('currentResearch', function () {
    return view('layouts.app');
});

