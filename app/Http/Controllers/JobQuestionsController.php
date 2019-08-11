<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Job $job
     * @return \Illuminate\Http\Response
     */
    public function index(Job $job)
    {
        $job->load('questions');

        return view('jobs.questions.index', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Job $job
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Job $job, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'jsonAttributes' => 'nullable|JSON'
        ]);

        $job->questions()->create([
            'title' => $request->title,
            'description' => $request->description,
            'attributes' => $request->jsonAttributes,
        ]);

        $this->makeResponse('Question stored successfully', '/' . $job->slugWithPrefix() . '/questions', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
