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

Route::get('/project', function () {
    return view('Project'); 
});

Route::get('/adminadduser', function () {
    return view('Admin_Dashboard_AddU'); 
});

Route::get('/dashthree', function () {
    return view('DashboardThree'); 
});

Route::get('/present', function () {
    return view('Admin_Present'); 
});

Route::get('/aplikasi', function () {
    return view('Admin_Aplikasi'); 
});

Route::get('/adu', function () {
    return view('ADU'); 
});

Route::get('/adp', function () {
    return view('ADP'); 
});

Route::get('/av', function () {
    return view('AV'); 
});


Route::get('/dpu', function () {
    return view('DPU'); 
});

Route::get('/unit', function () {
    return view('Admin_Unit'); 
});

Route::get('/edit', function () {
    return view('Edit_Profile'); 
});

Route::get('/cuti', function () {
    return view('Pengajuan_Cuti'); 
});

Route::get('/akses', function () {
    return view('Manajemen_Akses'); 
});

Route::get('/dashboardproject', function () {
    return view('dashboardproject'); 
});
Route::get('/dashboarduser', function () {
    return view('dashboarduser'); 
});