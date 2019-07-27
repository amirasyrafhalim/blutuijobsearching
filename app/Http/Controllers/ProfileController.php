<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $names = ['John', 'Munee', 'Noelle', 'Dhiya'];

        return view('profile.show', compact('names'));
    }

    /** Edit user profile */
    public function edit()
    {
        return view('profile.edit');
    }
}
