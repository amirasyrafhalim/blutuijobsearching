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
    public function edit(Job $job, $slug)
    {
        if($slug != Str::slug($job->title))
        {
            abort(404);
        }

        $freelancer = User::findOrFail($job->hired_user_id);
        $agency = User::findOrFail($job->user_id);

        if($freelancer->id == Auth::user()->id || $agency->id == Auth::user()->id) {

            return view('rating.edit', compact('freelancer', 'agency', 'job'));
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
    public function update(Request $request, Job $job, $slug)
    {
        //dd($request->rating);
        // Get the seller
        // Get the buyer
        // Attach ratings to rating table

        $freelancer = User::findOrFail($job->hired_user_id);
        $agency = User::findOrFail($job->user_id);

        if (Auth::user()->id == $freelancer->id)
        {
            $job->freelancer_rating = $request->rating;
            $job->freelancer_comment = $request->comment;
            $job->save();
        }

        if (Auth::user()->id == $agency->id)
        {
            $job->agency_rating = $request->rating;
            $job->agency_comment = $request->comment;
            $job->save();
        }

        return $this->makeResponse("Thank you for your ratings!", $job->slugWithPrefix(), 200);
    }

}
