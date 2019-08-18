<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisedJobsController extends Controller
{
    public function index()
    {
        $jobs = Auth::user()->appliedJobs()->get();

        return view('advertised_job.index', compact('jobs'));
    }
}
