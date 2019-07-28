<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        //$profile = Profile::all();

        return view('profile.show', compact('profile'));
    }
}
