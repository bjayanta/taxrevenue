@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                Report (Non Submited)
            </div>

            <div class="card-body">
                <form action="{{ route('report.nonSubmited') }}" method="GET">
                    <input type="hidden" name="search" value="1">

                    <div class="row">
                        <div class="form-group col-md-6 required">
                            <select name="tax_session_id" class="form-control" required>
                                <option value="" disabled selected>-- Select One --</option>

                                @foreach($sessions as $session)
                                    <option {{ (request()->tax_session_id == $session->id) ? 'selected' : '' }} value="{{ $session->id }}">{{ $session->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i> &nbsp;
                                Search
                            </button>
                        </div>
                    </div>
                </form>

                @if(request()->search == 1)
                    <hr>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <form action="{{ route('export.allNonSubmitedAssessee') }}" method="GET">
                                <input type="hidden" name="input" value="all-non-submited-assessees">
                                <input type="hidden" name="tax_session_id" value="{{ request()->tax_session_id }}">

                                <button type="submit">Export</button>
                            </form>
                        </div>

                        <!-- paginate -->
                        <div class="col-md-6">
                            <div class="float-right">
                                {{ (!empty($assessees)) ? $assessees->appends(request()->all())->links() : '' }}
                            </div>
                        </div>
                    </div>

                    <!-- table -->
                    <table class="table table-sm table-hover">
                        <thead>
                        <tr>
                            <th>SI</th>
                            <th>Assessee</th>
                            <th>Tin Number</th>
                            <th>Tin Date</th>
                            <th>Old Tin Number</th>

                            <!-- tax session -->
                            @foreach($sessions as $session)
                                <th class="text-right {{ (request()->tax_session_id == $session->id) ? 'bg-danger text-white' : '' }}">{{ $session->title }}</th>
                            @endforeach
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($assessees as $assessee)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $assessee->name }}</td>
                                <td><a href="{{ route('tax_return.edit', $assessee->id) }}">{{ $assessee->tin_number }}</a></td>
                                <td>{{ date("d/m/Y",strtotime($assessee->tin_date)) }}</td> 
                                <td>{{ $assessee->old_tin_number }}</td>

                                <!-- tax session -->
                                @foreach($sessions as $session)
                                    <td class="text-right {{ (request()->tax_session_id == $session->id) ? 'table-danger' : '' }}">
                                        @php
                                            $total[$session->id] += $assessee->taxSessions->find($session->id)->tax_return->amount ?? 0;
                                        @endphp

                                        {{ number_format(($assessee->taxSessions->find($session->id)->tax_return->amount ?? 0), 2) }}
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="80" class="text-center font-weight-bold table-danger">No record found</td>
                            </tr>
                        @endforelse

                        <tr>
                            <th colspan="5" class="text-right">Total</th>

                            @foreach($sessions as $session)
                                <th class="text-right {{ (request()->tax_session_id == $session->id) ? 'table-danger' : '' }}">{{ number_format($total[$session->id], 2) }}</th>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <form action="{{ route('export.allNonSubmitedAssessee') }}" method="GET">
                                <input type="hidden" name="input" value="all-non-submited-assessees">
                                <input type="hidden" name="tax_session_id" value="{{ request()->tax_session_id }}">

                                <button type="submit">Export</button>
                            </form>
                        </div>

                        <!-- paginate -->
                        <div class="col-md-6">
                            <div class="float-right">
                                {{ (!empty($assessees)) ? $assessees->appends(request()->all())->links() : '' }}
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
