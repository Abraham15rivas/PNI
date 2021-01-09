<?php

use Illuminate\Support\Facades\Route;

Route::prefix('statistics')->group(function () {
    Route::get('/investigators','InvestigatorController@index');
    Route::get('/investigators/profile','InvestigatorController@profile');
    Route::get('/investigators/interest','InvestigatorController@interest');
    Route::get('/investigators/current','InvestigatorController@current');
    Route::get('/investigators/all/states','InvestigatorController@allStates');
    Route::get('/investigators/all/{state}/municipalities','InvestigatorController@allMunicipalities');
    Route::get('/investigators/municipality/{state_id?}','InvestigatorController@searchMunicipality');
    Route::get('/investigators/parish/{municipality_id?}','InvestigatorController@searchParish');
});

Route::prefix('reports')->group(function () {
    Route::get('/date_min/{value}', 'ReportController@index');
    Route::post('/pdf', 'ReportController@pdf');
    Route::delete('/delete/pdf/{name}', 'ReportController@deleteReport');
});

Route::get('', function () {
    return view('layouts.app');
});

Route::get('home', function () {
    return view('layouts.app');
});

Route::get('investigadores', function () {
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

Route::get('reports', function () {
    return view('layouts.app');
});