@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Create/Upload Assessee List
                </div>

                <div class="card-body">
                    <form action="{{ route('assessee.store') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label for="assesse">Assesse name *</label>
                                <input type="text" required name="assesse" class="form-control" id="assesse" placeholder="Assesse name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tin_date">Tin Date *</label>
                                <input type="date" required name="tin_date" class="form-control" id="tin_date" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label for="tin_number">Tin Number *</label>
                                <input type="number" required name="tin_number" class="form-control" id="tin_number" placeholder="Tin number">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="old_tin_number">Old Tin Number (Optional)</label>
                                <input type="number" name="old_tin_number" class="form-control" id="old_tin_number" placeholder="Old tin number">
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <hr>
                    
                    <div class="row justify-content-md-center">
                        <div class="text-center">
                            <p class="mb-2"><strong>Or,</strong></p>

                            <form action="" method="post" enctype="multipart/form-data" class="text-center">
                                @csrf
                                
                                <div>
                                    <label for="upload" style="display: block;">Upload (.xlsx, .xls, .csv) *</label>
                                    <input type="file" name="file" accept=".xlsx, .xls, .csv" id="upload" style="width: 190px;" required>
                                    <small id="passwordHelpBlock" class="form-text text-muted">File extension must be .xlsx or, .xls or, .csv only.</small>
                                </div>
                                
                                <button type="submit" class="btn btn-primary mt-3 mb-2">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
