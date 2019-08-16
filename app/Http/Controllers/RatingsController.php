<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RatingsController extends Controller
{
    public function index(Request $request){
        $this->authorize('viewAny', Job::class);

        if($request->title != null){
            $jobs = Job::byTitleContains($request->title)->get();
        }else{
            $jobs = Job::published();
        }
        return view('jobs.index', compact('jobs'));

    }

    /**
     * Show create rate page.
     *
     * @param Job $job
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Job $job)
    {
        $this->authorize('create', $job);

        $user = Auth::user();

        return view('rating.create', compact('user', 'job'));
    }

    public function store(Request $request){
        $this->authorize('show', Job::class);

        $job = auth()->user()->jobs()->create([
            'user_id' => $request->user_id,
            'job_id' => $request->job_id,
            'seller_id' => $request->seller_id,
            'buyer_id' => $request->buyer_id,
            'seller_rate' => $request->seller_rate,
            'buyer_rate' => $request->buyer_rate,
        ]);
        return $this->makeResponse("Thank you for your ratings!", "/jobs/", 200);
    }

    public function show()
    {
        $seller = Auth::user();
        //$buyer = Auth::user();

        return $seller;
        //return $buyer;

        //return view('rating.show', compact('seller', 'buyer'));
    }
    public function edit(Job $job)
    {
        $this->authorize('update', $job);

        return view('jobs.edit', compact('job'));
    }

    public function update(Job $job, Request $request)
    {
        $this->authorize('update', $job);
        $request->validate([
            'job_id' => 'required',
            'seller_id' => 'required',
            'buyer_id' => 'required',
            'seller_rate' => 'required|numeric',
            'buyer_rate' => 'required|numeric',
        ]);
        $job->update([
            'job_id' => $request->job_id,
            'seller_id' => $request->seller_id,
            'buyer_id' => $request->buyer_id,
            'seller_rate' => $request->seller_rate,
            'buyer_rate' => $request->buyer_rate,
        ]);
        return $this->makeResponse("Ratings has been successfully updated", "/home/", 200);
    }
    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);

        $job->delete();

        return $this->makeResponse("Ratings has been successfully deleted", "/jobs/", 200);
    }
}
