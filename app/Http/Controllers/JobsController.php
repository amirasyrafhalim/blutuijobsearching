<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    /**
     * Show job page.
     *
     * @param Job $job
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Job $job, $slug)
    {
        if($slug != Str::slug($job->title))
        {
            abort(404);
        }

        return view('jobs.show', compact('job'));
    }
}
