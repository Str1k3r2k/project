<?php

use Illuminate\Support\Facades\Route;
use App\Models\job;
use Illuminate\Translation\ArrayLoader;
use Pest\Support\Arr as SupportArr;

Route::get('/', function () {
    return view('home');
});


Route::get('/jobs', function () {
    $jobs = Job::with('employer')->cursorPaginate(3);

    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function($id) {
    $job = Job::find($id);
    return view('job', ['job' => $job]);
});



Route::get('/contact', function () {
    return view('contact');
});