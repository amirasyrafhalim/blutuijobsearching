<?php

namespace App\Http\Controllers;

use App\Job;
use App\User;
use App\JobAnswer;
use App\JobQuestion;
use Illuminate\Support\Str;
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
     * Show all applicants applied for the job.
     *
     * @param Job $job
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Job $job, $slug)
    {
        if($slug != Str::slug($job->title)) {
            abort(404);
        }

        $job->load('applicants');

        return view('jobs.application.index', compact('job'));
    }

    /**
     * Show job application form.
     *
     * @param Job $job
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Job $job, $slug)
    {
        $job->load('questions');

        if($slug != Str::slug($job->title)) {
            abort(404);
        }

        return view('jobs.application.create', compact('job'));
    }

    /**
     * Store job to database
     *
     * @param Job $job
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Job $job, Request $request)
    {
        if($job->status != Job::STATUS_PUBLISHED) {
            abort(400);
        }

        $data = $request->except('_token');

        foreach($data as $key => $value) {
            $question = JobQuestion::findOrFail($key);
            if($question->job_id != $job->id) {
                abort(400);
            }

            $jobAnswer = new JobAnswer();
            $jobAnswer->job_id = $job->id;
            $jobAnswer->user_id = Auth::user()->id;
            $jobAnswer->question_id = $question->id;
            $jobAnswer->answers = json_encode($value);
            $jobAnswer->save();
        }

        $user = Auth::user();
        $user->appliedJobs()->sync($job->id);

        return $this->makeResponse('Job successfully applied', $job->slugWithPrefix(), 200);
    }
}
