@extends('layouts.app')
@section('title', 'Detail Data Permohonan Cuti')

@section('title-header', 'Detail Data Permohonan Cuti')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('submissions.index') }}">Data Permohonan Cuti</a></li>
    <li class="breadcrumb-item active">Detail Data Permohonan Cuti</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Detail Data Permohonan Cuti</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('submissions.update', ['submission' => $submission->uuid]) }}" method="post">
                    @csrf
                    @method('PUT')
                    {{-- make banner status --}}
                    @if ($submission->submission_status == 'pending')
                        <div class="alert alert-warning" role="alert">
                            <strong>Warning!</strong> Status Permohonan Cuti ini masih <strong>{{ 'menunggu konfirmasi' }}</strong>.
                        </div>
                    @elseif ($submission->submission_status == 'approved')
                        <div class="alert alert-success" role="alert">
                            <strong>Success!</strong> Status Permohonan Cuti ini sudah <strong>{{ 'diterima' }}</strong>.
                        </div>
                    @elseif ($submission->submission_status == 'rejected')
                        <div class="alert alert-danger" role="alert">
                            <strong>Warning!</strong> Status Permohonan Cuti ini sudah <strong>{{ 'ditolak' }}</strong>.
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="employee_id">Employee Name</label>
                                <select class="form-control @error('employee_id') is-invalid @enderror" id="employee_id"
                                    placeholder="Employee Name" name="employee_id" disabled>
                                    <option value="{{ $submission->employee->uuid }}">{{ $submission->employee->user->fullname }}</option>
                                </select>

                                @error('employee_id')
                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="submission_type">Submission Type</label>
                                <select class="form-control @error('submission_type') is-invalid @enderror"
                                    id="submission_type" placeholder="Submission Type" name="submission_type" disabled>
                                    <option value="{{ $submission->timeoff->uuid }}">{{ $submission->timeoff->description_timeoff }}
                                        ({{ $submission->timeoff->code_timeoff }})</option>
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
                                {{-- button download --}}
                                <br>
                                <a href="{{ asset('/uploads/submission_files/' . $submission->submission_file) }}" class="btn btn-sm btn-success" target="_blank">Download</a>
                                {{-- end button download --}}

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
                                <input type="date" class="form-control @error('start_timeoff') is-invalid @enderror"
                                    id="start_timeoff" placeholder="Start Timeoff" value="{{ old('start_timeoff', $submission->start_timeoff) }}"
                                    name="start_timeoff" disabled>

                                @error('start_timeoff')
                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="finish_timeoff">Finish Timeoff</label>
                                <input type="date" class="form-control @error('finish_timeoff') is-invalid @enderror"
                                    id="finish_timeoff" placeholder="Finish Timeoff" value="{{ old('finish_timeoff', $submission->finish_timeoff) }}"
                                    name="finish_timeoff" disabled>

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
                                <textarea class="form-control @error('submission_desc') is-invalid @enderror" id="submission_desc" disabled
                                    placeholder="Reason Timeoff" name="submission_desc" cols="30" rows="5">{{ old('submission_desc', $submission->submission_desc) }}</textarea>

                                @error('submission_desc')
                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            @if ($submission->submission_status == 'pending' && Auth::user()->role == 'admin')
                            {{-- button reject and approve --}}
                            <button type="submit" name="submission_status" value="approved" class="btn btn-sm btn-success">Approve</button>
                            <button type="submit" name="submission_status" value="rejected" class="btn btn-sm btn-danger">Reject</button>
                            {{-- end button reject and approve --}}
                            @endif

                            <a href="{{ route('submissions.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
