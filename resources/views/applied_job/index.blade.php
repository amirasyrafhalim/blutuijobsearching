@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your applied jobs.</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Job Title</th>
                <th scope="col">View</th>
                <th scope="col">Status</th>
                <th scope="col">Rate</th>
            </tr>
            </thead>
            <tbody>
            @foreach($jobs as $job)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $job->title }}</td>
                    <td><a href="/{{ $job->slugWithPrefix() }}">View</a></td>
                    @if($job->hired_user_id == Auth::user()->id)
                        <td><span class="badge badge-success">Hired</span></td>
                    @else
                        <td><span class="badge badge-warning">Pending</span></td>
                    @endif
                    @if($job->status == \App\Job::STATUS_COMPLETED)
                        <td><a href="/{{ $job->slugWithPrefix() }}/ratings">Rate</a></td>
                    @else
                        <td></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
