@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <p class="lead mb-0" style="font-size: 1.5rem;">Total Assessees</p>
                    <h4 class="display-4 mb-2" style="font-size: 1rem;">{{ $assessees }}</h4>
                </div>
            </div>
        </div>
    </div>

    <h5 class="mt-4 mb-2">Total collected revenue</h5>
    <div class="row">
        <div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        @foreach($sessions as $session)
           <div class="col-md-3">
               <div class="card border-0 shadow-sm mb-3">
                   <div class="card-body">
                        {{-- <div style="width: 60px; height: 60px;" class="rounded-circle d-flex align-items-center justify-content-center mb-2"> --}}
                        {{-- <img src="{{ asset('public/images/taka.svg') }}" class="img-fluid" alt=""/> --}}
                        {{-- </div> --}}
                        @foreach($tax_returns as $return)
                            @php
                                $total = $return->where('tax_session_id', $session->id)->sum('amount');
                            @endphp
                        @endforeach

                        <p class="lead mb-0" style="font-size: 1.5rem;">{{ $session->title }}</p>
                        <h4 class="display-4 mb-2" style="font-size: 1rem;">BDT {{ number_format($total, 2, '.', ',') }}</h4>
                   </div>
               </div>
           </div>
        @endforeach
    </div>

</div>
@endsection
