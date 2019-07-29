<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**show user profile */
    public function show()
    {
        $profile = Profile::all();

        return view('profile.show', compact('profile'));
    }

    /** Edit user profile */
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        Auth::user()->update([
            'name' => $request->name
            //'skills' => $request->skills
        ]);
    }
}
