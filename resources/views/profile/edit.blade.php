@extends('layouts.master')

@section('content')
    <!-- Main Content -->
    <div class="container col-md-8">
        <div class="row">
            <div class="col-md-12 pb-3">

                <!-- basic data -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="m-0">Update profile</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('profile.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Fullname</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ (old('name')) ? old('name') : $user->name }}" class="form-control" id="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email-address" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" value="{{ (old('email')) ? old('email') : $user->email }}" class="form-control" id="email-address">
                                </div>
                            </div>

                            <div class="form-group row required">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                            </div>

                            <div class="form-group row required">
                                <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- basic data end -->

            </div>
        </div>
    </div>
@endsection
