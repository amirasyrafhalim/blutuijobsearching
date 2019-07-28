<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
{
    /**
     * JobsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

    /**
     * Show all jobs.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->title != null) {
            dd($request->all());
        }

        $jobs = Job::all();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show create job page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store data to database.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
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

        return $this->makeResponse("Job $job->title successfully created", "/jobs/" . $job->slug(), 201);
    }

    /**
     * Show single job page.
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

    /**
     * Show job edit page.
     *
     * @param Job $job
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
        // Todo: Separate this logic to dedicated policy class.
        if($job->user_id != Auth::user()->id) {
            abort(403);
        }

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

        return $this->makeResponse("Job $job->title successfully updated", "/jobs/" . $job->slug(), 200);
    }

    /**
     * Soft delete the job.
     *
     * @param Job $job
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Job $job)
    {
        // Todo: Separate this logic to dedicated policy class.
        if($job->user_id != Auth::user()->id) {
            abort(403);
        }

        $job->delete();

        return $this->makeResponse("Job $job->title successfully deleted", "/jobs/", 200);
    }
}
