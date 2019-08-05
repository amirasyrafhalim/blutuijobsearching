@extends('layouts.app')

@section('content')
        <h1>Edit Profile</h1>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="/profile">
                                @csrf {{ method_field("PATCH") }}
                                <!-- name field -->
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" name="name" type="text" class="form-control">
                                    </div>
                                </div>

                                <!-- phoneNum field -->
                                <div class="form-group row">
                                    <label for="phoneNum" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                                    <div class="col-md-6">
                                        <input id="phoneNum" name="phoneNum" type="text" class="form-control">
                                    </div>
                                </div>

                                <!-- country field -->
                                <div class="form-group row">
                                    <label for="country" class="col-md-4 col-form-label text-md-right">Country</label>

                                    <div class="col-md-6">
                                        <input id="country" name="country" type="text" class="form-control">
                                    </div>
                                </div>

                                <!-- description field -->
                                <div class="form-group row">
                                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                                    <div class="col-md-6">
                                        <textarea id="description" name="description" type="text" class="form-control"></textarea>
                                    </div>
                                </div>

                                <!-- language field -->
                                <div class="form-group row">
                                    <label for="language" class="col-md-4 col-form-label text-md-right">Language</label>

                                    <div class="col-md-6">
                                        <input id="language" name="language" type="text" class="form-control">
                                    </div>
                                </div>

                                <!-- skills field -->
                                <div class="form-group row">
                                    <label for="skills" class="col-md-4 col-form-label text-md-right">Skills</label>

                                    <div class="col-md-6">
                                        <textarea id="skills" name="skills" type="text" class="form-control"></textarea>
                                    </div>
                                </div>

                                <!-- education field -->
                                <div class="form-group row">
                                    <label for="education" class="col-md-4 col-form-label text-md-right">Education</label>

                                    <div class="col-md-6">
                                        <textarea id="education" name="education" type="text" class="form-control"></textarea>
                                    </div>
                                </div>

                                <!-- cert field -->
                                <div class="form-group row">
                                    <label for="cert" class="col-md-4 col-form-label text-md-right">Certificate</label>

                                    <div class="col-md-6">
                                        <textarea id="cert" name="certificate" type="text" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary">
                                            Save
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
