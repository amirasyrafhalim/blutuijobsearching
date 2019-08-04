<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    /**
     * JobApplicationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store job application to database.
     * @param Job $job
     */
    public function store(Job $job)
    {
        $user = Auth::user();

        if($job->status != Job::STATUS_PUBLISHED) {
            abort(400);
        }

        $user->appliedJobs()->sync($job->id);

        return $this->makeResponse('Job successfully applied', $job->slugWithPrefix(), 200);
    }
}
