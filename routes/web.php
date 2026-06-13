<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dev', function () {
    // Do what thou wilt
});

Route::livewire('/quadratic', 'pages::quadratic');
Route::livewire('/ulam-spiral', 'pages::ulam-spiral');
Route::livewire('/test', 'pages::test');
