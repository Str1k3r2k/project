<?php

namespace App\Http\Controllers;

use App\Models\job;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\JobPosted;

class JobController extends Controller
{
    public function index(){
        $jobs = job::with('employer')->latest()->simplePaginate(10);
    
        return view('jobs.index', [
            'jobs' => $jobs
    ]);
    }

    public function create(){
        return view('jobs.create');
    }

    public function show(job $job){
        return view('jobs.show', ['job' => $job]);
    }

    public function store(){
        request()->validate([
            'title'     => ['required', 'min:3'],
            'salary'    => ['required', ''],
        ]);
    
        $job = job::create([
            'title'         => request('title'),
            'salary'        => request('salary'),
            'employer_id'   => 1,    
        ]);
    
        Mail::to($job->employer->user)->send(new JobPosted($job));
        

        return redirect('/jobs');
    }

    public function edit(job $job){

        Gate::authorize('edit', $job);


        return view('jobs.edit', ['job' => $job]);
    }

    public function update(job $job){
        Gate::authorize('edit', $job);

        request()->validate([
            'title'     => ['required', 'min:3'],
            'salary'    => ['required', ''],
        ]);
    
        $job->update([
            'title'         => request('title'),
            'salary'        => request('salary'),
        ]);       
    
        return redirect('/jobs/' . $job->id);
    }

    public function delete(job $job){
        Gate::authorize('edit', $job);
        
        $job->delete();
    return redirect('/jobs');
    }
}
