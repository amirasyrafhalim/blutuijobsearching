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
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Job $job, Request $request)
    {
        foreach ($request->all() as $question) {
            $validator = Validator::make($question, [
                'title' => 'required|max:255',
                'description' => 'nullable',
                'attributes' => 'JSON'
            ]);

            // For now
            if ($validator->fails()) {
                abort(400, 'Validation error for question ' . $question->title);
            }

            $job->questions()->create([
                'title' => $question['title'],
                'description' => $question['description'],
                'attributes' => $question['attributes']
            ]);
        }

        return redirect('/' . $job->slugWithPrefix() . '/questions')->with('message', 'Updated question successfully');
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
