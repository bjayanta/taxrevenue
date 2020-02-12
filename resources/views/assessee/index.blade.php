@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Records</div>

                <div>
                    <a href="{{ route('assessee.create') }}" class="btn btn-primary" title="create new.">Add New</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('assessee.index') }}" method="GET">
                    <input type="hidden" name="search" value="1">

                    <div class="row">
                        <div class="form-group col-md-6 required">
                            <input type="text" class="form-control" name="tin_number" placeholder="Enter Tin Number">
                        </div>

                        <div class="form-group col-md-2 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i> &nbsp;
                                Search
                            </button>
                        </div>
                    </div>
                </form>
                <hr>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <form action="{{ route('export.allAssessee') }}" method="GET">
                            <button type="submit">Export</button>
                        </form>
                    </div>

                    <!-- paginate -->
                    <div class="col-md-6">
                        <div class="float-right">
                            {{ $assessees->links() }}
                        </div>
                    </div>
                </div>

                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>SI</th>
                        <th>Assessee</th>
                        <th>Tin Number</th>
                        <th>Tin Date</th>
                        <th>Old Tin Number</th>

                        <!-- tax session -->
                        @foreach($sessions as $session)
                            <th class="text-right">{{ $session->title }}</th>
                        @endforeach
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($assessees as $assessee)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $assessee->name }}</td>
                                <td>
                                    <a href="{{ route('tax_return.edit', $assessee->id) }}">{{ $assessee->tin_number }}</a>
                                </td>
                                <td>{{ $assessee->tin_date }}</td>
                                <td>{{ $assessee->old_tin_number }}</td>

                                <!-- tax session -->
                                @foreach($sessions as $session)
                                    @php
                                        $amount = (Tax::getTaxReturnDetails($assessee->id, $session->id) != null) ? Tax::getTaxReturnDetails($assessee->id, $session->id)->amount : 0;
                                    @endphp

                                    @if($amount > 0)
                                        <td class="text-right">
                                            @php
                                                $total[$session->id] += $amount;
                                            @endphp

                                            {{ number_format($amount, 2, '.', ',') }}
                                        </td>
                                    @else
                                        <td class="text-right">0.00</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach

                        <tr>
                            <th colspan="5" class="text-right">Total</th>

                            @foreach($sessions as $session)
                                <th class="text-right">{{ number_format($total[$session->id], 2, '.', ',') }}</th>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('export.allAssessee') }}" method="GET">
                            <button type="submit">Export</button>
                        </form>
                    </div>

                    <!-- paginate -->
                    <div class="col-md-6">
                        <div class="float-right">
                            {{ $assessees->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
