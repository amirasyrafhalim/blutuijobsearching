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
            'title' => 'required',
            'document' => 'file|required'
        ]);

        $document = $request->file('document');
        $path = $document->store('public/user/' . Auth::user()->id . '/documents/');

        $userDocument = Auth::user()->documents()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $userDocument->path_url = $path;
        $userDocument->save();

        return redirect()->back();
    }
}
