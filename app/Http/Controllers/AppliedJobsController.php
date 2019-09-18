<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppliedJobsController extends Controller
{
    public function index()
    {
        $jobs = Auth::user()->appliedJobs()->get();

        return view('applied_job.index', compact('jobs'));
    }
}
