<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobAnswer;
use App\User;
use Illuminate\Http\Request;

class HiringApplicantController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Job $job, User $applicant)
    {
        $job->hired_user_id = $applicant->id;
        $job->save();

        $job->applicants()->where('user_id', $applicant->id)->first();

        return redirect('/' . $job->slugWithPrefix() . '/applications')->with('message', $applicant->name . ' is hired for this job');
    }

    /**
     * Get the user application.
     *
     * @param Job $job
     * @param User $applicant
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Job $job, User $applicant)
    {
        $job->load('questions');

        $job->questions->each(function($question) use ($applicant) {
            // This can be simplified. (N+1 problem)
            $question->answer = JobAnswer::where(['question_id' => $question->id, 'user_id' => $applicant->id])->first();
        });

        return view('jobs.application.show', compact('job', 'applicant'));
    }
}
