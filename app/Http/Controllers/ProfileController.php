<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        if (Auth::guest())
        {
            return redirect('/login');
        }

        $user = Auth::user();

        $appliedJobs = Auth::user()->appliedJobs()->get();
        $advertisedJobs = Auth::user()->jobs()->get();

        return view('profile.show', compact('user', 'appliedJobs', 'advertisedJobs'));
    }

    /** Edit user profile */
    public function edit()
    {
        if (Auth::guest())
        {
            return redirect('/login');
        }

        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /** Edit user profile */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $user = Auth::user()->update([
            'name' => $request->name,
            'phoneNum' => $request->phoneNum,
            'country' => $request->country,
            'description' => $request->description,
            'language' => $request->language,
            'skills' => $request->skills,
            'education' => $request->education,
            'cert' => $request->cert,
        ]);

        return $this->makeResponse("Profile successfully updated", "/profile/", 200);
    }
}
