@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your advertised jobs.</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Job Title</th>
                <th scope="col">View Applicants</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($jobs as $job)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><a href="/{{ $job->slugWithPrefix() }}">{{ $job->title }}</a></td>
                    <td><a href="/{{ $job->slugWithPrefix() }}/applications">Applicants</a></td>
                    <td><span class="badge badge-success">{{ \App\Job::STATUS_TYPE[$job->status] }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
