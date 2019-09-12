<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDocumentsController extends Controller
{
    public function create()
    {
        $documents = Auth::user()->documents()->get();

        return view('documents.create', compact('documents'));
    }

    //Store the uploaded file
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        Auth::user()->documents()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back();
    }
}
