<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;

class JobsController extends Controller
{
    /**
     * JobsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Show all jobs.
     *
     * @return Factory|View
     */
    public function index()
    {
        $jobs = Job::all();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show create job page.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store job to database
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5',
            'price' => 'required|numeric|min:1|max:99999',
        ]);

        $job = auth()->user()->jobs()->create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price * 100
        ]);

        return response("Job $job->title successfully created", 201);
    }

    /**
     * Show job page.
     *
     * @param Job $job
     * @param $slug
     * @return Factory|View
     */
    public function show(Job $job, $slug)
    {
        if($slug != Str::slug($job->title))
        {
            abort(404);
        }

        return view('jobs.show', compact('job'));
    }

    /**
     * Show job edit page.
     *
     * @param Job $job
     * @return Factory|View
     */
    public function edit(Job $job)
    {
        // Todo: Separate this logic to dedicated policy class.
        if($job->user_id != Auth::user()->id) {
            abort(403);
        }

        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the job.
     *
     * @param Job $job
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Job $job, Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5',
            'price' => 'required|numeric|min:1|max:99999',
        ]);

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price * 100
        ]);

        return response("Job $job->title successfully updated", 201);
    }
}
