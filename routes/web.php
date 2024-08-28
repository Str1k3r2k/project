<?php

use Illuminate\Support\Facades\Route;
use App\Models\job;
use Illuminate\Translation\ArrayLoader;
use Pest\Support\Arr as SupportArr;

Route::get('/', function () {
    return view('home');
});




Route::get('/jobs', function () {
    $jobs = job::with('employer')->latest()->simplePaginate(10);
    
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::get('/jobs/{id}', function($id) {
    $job = job::find($id);
    return view('jobs.show', ['job' => $job]);
});

Route::post('/jobs', function (){
    job::create([
        'title'         => request('title'),
        'salary'        => request('salary'),
        'employer_id'   => 1,    
    ]);

    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});