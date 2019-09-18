@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Job applicants for {{ $job->title }}</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Application</th>
                <th scope="col">Hiring</th>
            </tr>
            </thead>
            <tbody>
            @foreach($job->applicants as $applicant)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $applicant->name }}</td>
                    <td><a href="/jobs/{{ $job->id }}/applicant/{{ $applicant->id }}">View</a></td>
                    @if($job->hired_user_id == $applicant->id)
                        <td><span class="badge badge-success">Hired</span></td>
                    @else
                        <td></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
