@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                Tax Return Entry
            </div>

            <div class="card-body">
                <form action="{{ url("tax_return/add_tax") }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="tin-number">Tin Number *</label>
                        <input type="text" name="tin_number" class="form-control" id="tin-number" required>
                    </div>

                    <button type="submit" class="btn btn-success">Search</button>
                </form>
            </div>
        </div>
    </div>
@endsection
