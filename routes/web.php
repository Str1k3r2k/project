<?php

use Illuminate\Support\Facades\Route;
use App\Models\job;
use Illuminate\Translation\ArrayLoader;
use Pest\Support\Arr as SupportArr;

Route::get('/', function () {
    return view('home');
});


Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => Job::all()
    ]);
});

Route::get('/jobs/{id}', function($id) {
    $job = Job::find($id);
    return view('job', ['job' => $job]);
});



Route::get('/contact', function () {
    return view('contact');
});