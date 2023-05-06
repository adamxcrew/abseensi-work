@extends('layouts.app')
@section('title', 'Submit Presensi')

@section('title-header', 'Submit Presensi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Submit Presensi</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Absensi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('presences.store') }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="attendance_image" value="{{ $attendance_image }}">
                        <input type="hidden" name="attendance_date_clock" value="{{ $attendance_date_clock }}">
                        <input type="hidden" name="attendance_longitude_lat" value="{{ $attendance_longitude_lat }}">
                        <input type="hidden" name="presences_type" value="{{ $presences_type }}">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="attendance_image">Foto Absensi</label>
                                    <br>

                                    {{-- img --}}
                                    <img src="{{ $attendance_image }}" alt="Attendance Image" class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="attendance_date_clock">Tanggal, Jam Absensi</label>
                                    <h5>
                                        {{ $attendance_date_clock }}
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="attendance_longitude_lat">Lokasi</label>
                                    <br>
                                    @if (!$attendance_longitude_lat)
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Peringatan!</strong> Lokasi tidak ditemukan, silahkan coba lagi.
                                        </div>
                                    @else
                                    <a href="https://www.google.com/maps/search/{{ $attendance_longitude_lat }}" target="_blank" class="btn btn-primary btn-sm">Temukan Lokasi</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="presence_status">Status Absensi</label>
                                    <select class="form-control @error('presence_status') is-invalid @enderror" id="presence_status"
                                    placeholder="Status Absensi" name="presence_status" required>
                                        @php
                                            $status = ['Hadir', 'Izin', 'Sakit', 'Alpa'];
                                        @endphp

                                        @foreach ($status as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>

                                    @error('presence_status')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="presence_desc">Deskripsi Kehadiran <small class="text-danger">*optional</small></label>
                                    <textarea class="form-control @error('presence_desc') is-invalid @enderror" id="presence_desc"
                                    placeholder="Deskripsi Kehadiran" name="presence_desc" cols="30" rows="5">{{ old('presence_desc') }}</textarea>

                                    @error('presence_desc')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('home', []) }}" class="btn btn-sm btn-secondary">Batalkan Absensi</a>

                                @if ($attendance_longitude_lat)
                                    <button type="submit" class="btn btn-sm btn-primary">Absensi</button>

                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
