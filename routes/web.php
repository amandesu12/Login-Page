<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard'); 
});

Route::get('/task', function () {
    return view('TaskPage'); 
});

Route::get('/dashboardtwo', function () {
    return view('DashboardTwo'); 
});

Route::get('/taskpage', function () {
    return view('TaskPage'); 
});


Route::get('/reportsusr', function () {
    return view('ReportsU'); 
});

Route::get('/dashboarda', function () {
    return view('DashboardAdmin'); 
});