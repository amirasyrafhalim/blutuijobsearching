<?php

namespace App\Http\Controllers;

use App\Job;
use App\Rating;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RatingsController extends Controller
{
    /*public function index(Request $request){
        $this->authorize('viewAny', Job::class);

        if($request->title != null){
            $jobs = Job::byTitleContains($request->title)->get();
        }else{
            $jobs = Job::published();
        }
        return view('jobs.index', compact('jobs'));

    }*/

    /**
     * Show create rate page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Job $job, $slug)
    {
        if($slug != Str::slug($job->title))
        {
            abort(404);
        }

        $freelancer = User::findOrFail($job->hired_user_id);
        $agency = User::findOrFail($job->user_id);

        if($freelancer->id == Auth::user()->id || $agency->id == Auth::user()->id) {
            return view('rating.create', compact('freelancer', 'agency', 'job'));
        }

        abort(403);
    }

    /**
     * Store rating to database.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Job $job, $slug)
    {
        dd($request->rating);
        // Get the seller
        // Get the buyer
        // Attach ratings to rating table

        $freelancer = User::findOrFail($job->hired_user_id);
        $agency = User::findOrFail($job->user_id);

        if (Auth::user()->id == $freelancer->id)
        {
            $job->freelancer_rating = $request->rating;
            $job->save();
        }

        if (Auth::user()->id == $agency->id)
        {
            $job->agency_rating = $request->rating;
            $job->save();
        }

        return $this->makeResponse("Thank you for your ratings!", "/rating/create", 200);
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
