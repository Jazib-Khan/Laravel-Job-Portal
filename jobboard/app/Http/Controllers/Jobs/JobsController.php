<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job\Job;

class JobsController extends Controller
{
    public function single($id) {
        
        $job = Job::find($id);

        //getting related jobs

        $relatedJobs = Job::where('category', $job->category)
        ->where('id', '!=', $job->id)
        ->take(5)
        ->get();

        $relatedJobsCount = Job::where('category', $job->category)
        ->where('id', '!=', $job->id)
        ->take(5)
        ->count();

        return view('jobs.single', compact('job', 'relatedJobs', 'relatedJobsCount'));
    }
}
