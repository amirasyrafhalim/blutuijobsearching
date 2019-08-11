@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Application for {{ $job->title }}</div>
                    <div class="card-body">
                        <form method="POST" action="/{{ $job->slugWithPrefix() }}/apply">
                            @csrf

                            @foreach($job->questions as $question)
                                <div class="form-group row">
                                    <label for="{{ $question->id }}" class="col-md-12 col-form-label text-md-left">{{ $question->title }}</label>
                                    <small class="col-md-12">{{ $question->description }}</small>

                                    <div class="col-md-12">
                                        <textarea id="{{ $question->id }}" name="{{ $question->id }}" class="form-control"></textarea>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group row mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
