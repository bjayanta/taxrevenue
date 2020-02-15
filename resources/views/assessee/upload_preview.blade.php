@extends('layouts.master')

@section('content')
<div class="container">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                Preview
            </div>

            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Tin Number</th>
                        <th>Old Tin Number</th>
                        <th>Tin Date</th>
                        <th>Circle ID</th>
                    </tr>

                    @foreach($data as $key=>$row)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $row["name"]  }}</td>
                        <td>{{ $row["tin_number"]  }}</td>
                        <td>{{ $row["old_tin_number"]  }}</td>
                        <td>{{ $row["tin_date"]  }}</td>
                        <td>{{ $row["circle_id"]  }}</td>
                    </tr>
                    @endforeach
                </table>

                <form action="{{ url("assessee/confirm_upload")  }}" method="post">
                    @csrf
                    <input type="hidden" name="data" value="{{ json_encode($data)  }}">
                    <input type="submit" name="confirm" value="Confirm">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
