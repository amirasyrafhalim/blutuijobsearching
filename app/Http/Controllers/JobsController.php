<?php

namespace App\Http\Controllers;

use App\Image;
use App\Job;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Job::class);

        if($request->title != null) {
            $jobs = Job::byTitleContains($request->title)->get();
        } else {
            $jobs = Job::published();
        }

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show create job page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Job::class);

        return view('jobs.create');
    }

    /**
     * Store job to database.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Job::class);

        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5',
            'price' => 'required|numeric|min:1|max:99999',
            'expected_delivery_date' => 'date',
            'status' =>'required|in:' . implode(',', Job::STATUSES),
        ]);

        $job = auth()->user()->jobs()->create([
            'title' => $request->title,
            'description' => $request->description,
            'expected_delivery_date' => Carbon::parse($request->expected_delivery_date)->format('Y-m-d H:i:s'),
            'price' => $request->price * 100,
            'status' => $request->status,
        ]);

        $images = $request->file('images');

        if($images != null) {
            foreach ($images as $image) {
                $path = $image->store('public/job_images/' . $job->id);
                $job->images()->create(['path' => $path]);
            }

            $defaultImage = $job->images()->first();
            $defaultImage->is_default = Image::DEFAULT_IMAGE;
            $defaultImage->save();
        }

        return $this->makeResponse("Job $job->title successfully created", "/jobs/" . $job->slug() . "/questions", 201);
    }

    /**
     * Show single job page.
     *
     * @param Job $job
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Job $job, $slug)
    {
        $this->authorize('create', $job);

        $job->load('images');

        if($slug != Str::slug($job->title))
        {
            abort(404);
        }

        return view('jobs.show', compact('job'));
    }

    /**
     * Show edit job page.
     *
     * @param Job $job
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Job $job)
    {
        $this->authorize('update', $job);

        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the job.
     *
     * @param Job $job
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Job $job, Request $request)
    {
        $this->authorize('update', $job);

        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5',
            'price' => 'required|numeric|min:1|max:99999',
            'expected_delivery_date' => 'date',
            'status' =>'required|in:' . implode(',', Job::STATUSES),
        ]);

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price * 100,
            'expected_delivery_date' => $request->expected_delivery_date,
            'status' => $request->status,
        ]);

        return $this->makeResponse("Job $job->title successfully updated", "/jobs/" . $job->slug(), 200);
    }

    /**
     * Delete job.
     *
     * @param Job $job
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);

        $job->delete();

        return $this->makeResponse("Job $job->title successfully deleted", "/jobs/", 200);
    }
}
