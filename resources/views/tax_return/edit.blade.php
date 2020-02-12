@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <!-- aside -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Assessee Details
                    </div>

                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <th>Name</th>
                                <td>:</td>
                                <td>{{ $assessee->name }}</td>
                            </tr>

                            <tr>
                                <th>Tin Number </th>
                                <td>:</td>
                                <td>{{ $assessee->tin_number }}</td>
                            </tr>

                            <tr>
                                <th>Tin Date </th>
                                <td>:</td>
                                <td>{{ $assessee->tin_date }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- form -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Return Register Form
                    </div>

                    <div class="card-body">
                        <div class="col-md-8 mx-auto">
                            <form action="{{ route('tax_return.update', $assessee->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <!-- all hidden fields  -->
                                <input type="hidden" name="assessee_id" value="{{ $assessee->id }}">

                                @foreach($tax_sessions as $session)
                                    @if(isset(Tax::getTaxReturnDetails($assessee->id, $session->id)->amount))
                                        <div class="form-group">
                                            <label for="session">{{ $session->title }}</label>
                                            <input type="text" name="amount[]" value="{{ Tax::getTaxReturnDetails($assessee->id, $session->id)->amount }}" class="form-control">
                                            <input type="hidden" name="tax_session[]" value="{{ $session->id }}">
                                        </div>
                                    @else 
                                        <div class="form-group">
                                            <label for="session">{{ $session->title }}</label>
                                            <input type="text" name="amount[]" class="form-control" placeholder="0.00">
                                            <input type="hidden" name="tax_session[]" value="{{ $session->id }}">
                                        </div>
                                    @endif
                                @endforeach

                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
