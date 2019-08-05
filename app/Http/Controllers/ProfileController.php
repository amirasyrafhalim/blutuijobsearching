<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return view('profile.show', compact('user'));
    }

    /** Edit user profile */
    public function edit()
    {
        return view('profile.edit');
    }

    /** Edit user profile */
    public function update(Profile $profile, Request $request)
    {
        $this->authorize('update', $profile);

        $request->validate([
            'name' => 'required',
            'phoneNum' => 'required',
            'country' => 'required',
            'description' => 'required',
            'language' => 'required',
            'skills' => 'required',
            'education' => 'required',
            'cert' => 'required',
        ]);

        Auth::user()->update([
            'name' => $request->name,
            'phoneNum' => $request->phoneNum,
            'country' => $request->country,
            'description' => $request->description,
            'language' => $request->language,
            'skills' => $request->skills,
            'education' => $request->education,
            'cert' => $request->nacertme,
        ]);

        return $this->makeResponse("Profile $profile->name successfully updated", "/profile/" . $profile->slug(), 200);
    }
}
