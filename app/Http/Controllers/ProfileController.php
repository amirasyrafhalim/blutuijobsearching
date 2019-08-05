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
    public function update(Request $request)
    {
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
    }
}
