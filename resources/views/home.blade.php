@extends('layouts.master')

@section('content')
<div class="container col-md-8">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center">
                        <h5 class="card-title">Total Assessee is: {{ $assessees }}</h5>

                        @foreach($sessions as $session)
                            <p class="card-text">Total Revenue in {{ $session->title }} :
                                @foreach($tax_returns as $return)
                                    @php
                                        $total = $return->where('tax_session_id', $session->id)->sum('amount');
                                    @endphp
                                @endforeach
                                <span style="font-size: large">{{ $total }}</span>
                            </p>
                        @endforeach
                    </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
