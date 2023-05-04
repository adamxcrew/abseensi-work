@extends('layouts.app')
@section('title', 'Tambah Data Jenis Cuti')

@section('title-header', 'Tambah Data Jenis Cuti')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('timeoff-settings.index') }}">Data Jenis Cuti</a></li>
    <li class="breadcrumb-item active">Tambah Data Jenis Cuti</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Jenis Cuti</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('timeoff-settings.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="jenis_timeoff">Jenis Cuti</label>
                                    <input type="text" class="form-control @error('jenis_timeoff') is-invalid @enderror" id="jenis_timeoff"
                                        placeholder="Jenis Cuti" value="{{ old('jenis_timeoff') }}" name="jenis_timeoff">

                                    @error('jenis_timeoff')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="description_timeoff">Deskripsi Jenis Cuti</label>
                                    <input type="text" class="form-control @error('description_timeoff') is-invalid @enderror" id="description_timeoff"
                                        placeholder="Deskripsi Jenis Cuti" value="{{ old('description_timeoff') }}" name="description_timeoff">

                                    @error('description_timeoff')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="code_timeoff">Kode Jenis Cuti</label>
                                    <input type="text" class="form-control @error('code_timeoff') is-invalid @enderror" id="code_timeoff"
                                        placeholder="Kode Jenis Cuti" value="{{ old('code_timeoff') }}" name="code_timeoff">

                                    @error('code_timeoff')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="durasi_timeoff">Durasi Jenis Cuti (hari)</label>
                                    <input type="number" class="form-control @error('durasi_timeoff') is-invalid @enderror" id="durasi_timeoff"
                                        placeholder="Durasi Jenis Cuti" value="{{ old('durasi_timeoff') }}" name="durasi_timeoff">

                                    @error('durasi_timeoff')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{route('timeoff-settings.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
