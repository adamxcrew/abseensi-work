@extends('layouts.app')
@section('title', 'Tambah Data Permohonan Cuti')

@section('title-header', 'Tambah Data Permohonan Cuti')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('submissions.index') }}">Data Permohonan Cuti</a></li>
    <li class="breadcrumb-item active">Tambah Data Permohonan Cuti</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Permohonan Cuti</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('submissions.store') }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf

                        @if (Auth::user()->role == 'admin')

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="employee_id">Employee Name</label>
                                    <select class="form-control @error('employee_id') is-invalid @enderror" id="employee_id"
                                        placeholder="Employee Name" name="employee_id" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->user->fullname }}</option>
                                        @endforeach
                                    </select>

                                    @error('employee_id')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @else
                            <input type="hidden" name="employee_id" value="{{ Auth::user()->employee->id }}">
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="submission_type">Submission Type</label>
                                    <select class="form-control @error('submission_type') is-invalid @enderror" id="submission_type"
                                        placeholder="Submission Type" name="submission_type" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($timeoffs as $timeoff)
                                            <option value="{{ $timeoff->id }}">{{ $timeoff->description_timeoff }} ({{ $timeoff->code_timeoff }})</option>
                                        @endforeach
                                    </select>

                                    @error('submission_type')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="submission_file">Submission File</label>
                                    <input type="file" class="form-control @error('submission_file') is-invalid @enderror" id="submission_file"
                                        placeholder="Submission File" value="{{ old('submission_file') }}" name="submission_file">

                                    @error('submission_file')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="start_timeoff">Start Timeoff</label>
                                    <input type="date" class="form-control @error('start_timeoff') is-invalid @enderror" id="start_timeoff"
                                        placeholder="Start Timeoff" value="{{ old('start_timeoff') }}" name="start_timeoff">

                                    @error('start_timeoff')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="finish_timeoff">Finish Timeoff</label>
                                    <input type="date" class="form-control @error('finish_timeoff') is-invalid @enderror" id="finish_timeoff"
                                        placeholder="Finish Timeoff" value="{{ old('finish_timeoff') }}" name="finish_timeoff">

                                    @error('finish_timeoff')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="submission_desc">Reason Timeoff</label>
                                    <textarea class="form-control @error('submission_desc') is-invalid @enderror" id="submission_desc"
                                    placeholder="Reason Timeoff" name="submission_desc" cols="30" rows="5">{{ old('submission_desc') }}</textarea>

                                    @error('submission_desc')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{ route('submissions.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
