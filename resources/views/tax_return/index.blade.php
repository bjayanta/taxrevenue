@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Records</div>

                <div>
                    <button class="btn btn-primary print-none" type="button" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch">Search</button>
                    <a href="{{ route('tax_return.create') }}" class="btn btn-primary" title="create new.">Add New</a>
                </div>
            </div>

            <div class="card-body">
                <div class="collapse" id="collapseSearch">
                    <form action="#" method="GET">
                        <input type="hidden" name="search" value="1">

                        <div class="row">
                            <div class="form-group col-md-3 required">
                                <input type="text" class="form-control" name="tin_number" placeholder="Enter tin number">
                            </div>

                            <div class="form-group col-md-4 required">
                                <input type="text" class="form-control" name="date" placeholder="Enter date">
                            </div>

                            <div class="form-group col-md-3 required">
                                <input type="text" class="form-control" name="assess" placeholder="Enter assess name">
                            </div>

                            <div class="form-group col-md-2 text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i> &nbsp;
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <table class="table table-sm table-hover">
                    <thead>
                    <tr>
                        <th>SI</th>
                        <th>Assessee</th>
                        <th>Tin Number</th>
                        <th>Tin Date</th>
                        <th class="text-right print-none">Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
