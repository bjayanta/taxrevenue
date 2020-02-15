@extends('layouts.master')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid col-md-8">
        <div class="row">

            <!-- Profile -->
            <div class="col-md-12 mb-3">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">{{ $record->name }}</h5>
                        <p class="card-text">{{ $record->email }}</p>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('profile.edit', $record->id) }}" class="card-link">Edit Profile</a>
                    </div>
                </div>
            </div>
            <!-- End of the profile -->

            <!-- Details -->
            <div class="col-md-12">
                <article>
                    <h4>Account</h4>
                    <p>Account create at <strong>{{ $record->created_at->format('j F, Y') }}</strong> and last updated at <strong>{{ $record->updated_at->format('j F, Y') }}</strong></p>
                </article>
                <hr>

            </div>
            <!-- Details end -->

        </div>
    </div>
@endsection

