@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Job applicants for {{ $job->title }}</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Profile</th>
                <th scope="col">Application</th>
            </tr>
            </thead>
            <tbody>
            @foreach($job->applicants as $applicant)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $applicant->name }}</td>
                    <td><a href="/{{ $applicant->name }}">Profile</a></td>
                    <td>View</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
