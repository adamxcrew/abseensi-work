@extends('layouts.app')
@section('title', 'Ubah Data pengguna')

@section('title-header', 'Ubah Data pengguna')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Data pengguna</a></li>
    <li class="breadcrumb-item active">Ubah Data pengguna</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Ubah Data pengguna</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h6 class="heading-small text-muted mb-4">User information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" placeholder="Nama pengguna" value="{{ old('name', $user->name) }}"
                                            required name="name">

                                        @error('name')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="email" placeholder="Email pengguna" value="{{ old('email', $user->email) }}"
                                            required name="email">

                                        @error('email')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="role">Role</label>
                                        <select class="form-control @error('role') is-invalid @enderror" id="role"
                                            required name="role">
                                            @php
                                                $roles = ['admin', 'tu', 'teacher'];
                                            @endphp
                                            <option value="" selected>---Role---</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}"
                                                    @if (old('role', $user->role) == $role) selected @endif>
                                                    {{ $role }}</option>
                                            @endforeach
                                        </select>

                                        @error('role')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="avatar">Avatar</label>
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                    id="avatar" placeholder="Avatar pengguna" name="avatar">

                                @error('avatar')
                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <hr class="my-4" />

                        <h6 class="heading-small text-muted mb-4">Personal information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="nik">NIK</label>
                                        <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                            id="nik" placeholder="NIK pengguna"
                                            value="{{ old('nik', $user->personal?->nik) }}" required name="nik" required>

                                        @error('nik')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group mb-3">
                                        <label for="address">Alamat</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Alamat pengguna"
                                            required name="address" cols="30" rows="3">{{ old('address', $user->personal?->address) }}</textarea>

                                        @error('address')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-3">
                                        <label for="birth_place">Tempat lahir</label>
                                        <input type="text"
                                            class="form-control @error('birth_place') is-invalid @enderror"
                                            id="birth_place" placeholder="Tempat lahir pengguna"
                                            value="{{ old('birth_place', $user->personal?->birth_place) }}"
                                            required name="birth_place">

                                        @error('birth_place')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-3">
                                        <label for="birth_date">Tanggal lahir</label>
                                        <input type="date"
                                            class="form-control @error('birth_date') is-invalid @enderror" id="birth_date"
                                            placeholder="Tanggal lahir pengguna"
                                            value="{{ old('birth_date', $user->personal?->birth_date) }}"
                                            required name="birth_date">

                                        @error('birth_date')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="phone_number">Nomor telepon</label>
                                        <input type="number"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            id="phone_number" placeholder="Nomor telepon pengguna"
                                            value="{{ old('phone_number', $user->personal?->phone_number) }}"
                                            required name="phone_number">

                                        @error('phone_number')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="gender">Jenis Kelamin</label>
                                        <select class="form-control @error('gender') is-invalid @enderror" id="gender"
                                            required name="gender">
                                            @php
                                                $roles = ['male', 'female'];
                                            @endphp
                                            <option value="" selected>---Jenis Kelamin---</option>
                                            @foreach ($roles as $gender)
                                                <option value="{{ $gender }}"
                                                    @if (old('gender', $user->personal?->gender) == $gender) selected @endif>
                                                    {{ $gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</option>
                                            @endforeach
                                        </select>

                                        @error('gender')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="religion">Agama</label>
                                        <select class="form-control @error('religion') is-invalid @enderror"
                                            id="religion" required name="religion">
                                            @php
                                                $roles = ['islam', 'kristen', 'buddha', 'katolik', 'konghucu'];
                                            @endphp
                                            <option value="" selected>---Agama---</option>
                                            @foreach ($roles as $religion)
                                                <option value="{{ $religion }}"
                                                    @if (old('religion', $user->personal?->religion) == $religion) selected @endif>
                                                    {{ ucfirst($religion) }}</option>
                                            @endforeach
                                        </select>

                                        @error('religion')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="marriage">Status Perkawinan</label>
                                        <input type="text"
                                            class="form-control @error('marriage') is-invalid @enderror" id="marriage"
                                            placeholder="Status Perkawinan pengguna"
                                            value="{{ old('marriage', $user->personal?->marriage) }}" required name="marriage">

                                        @error('marriage')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />

                        <h6 class="heading-small text-muted mb-4">Employee information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="uuid">Kode Unik</label>
                                        <input type="text" class="form-control @error('uuid') is-invalid @enderror"
                                            id="uuid" placeholder="Kode Unik pengguna (diisi otomatis)"
                                            value="{{ old('uuid', $user->employee?->uuid) }}" name="uuid" disabled>

                                        @error('uuid')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="employee_stats">Status Pekerja</label>
                                        <input type="text"
                                            class="form-control @error('employee_stats') is-invalid @enderror"
                                            id="employee_stats" placeholder="Status Pekerja pengguna"
                                            value="{{ old('employee_stats', $user->employee?->employee_stats) }}"
                                            name="employee_stats">

                                        @error('employee_stats')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="employee_tier">Posisi Pekerja</label>
                                        <input type="text"
                                            class="form-control @error('employee_tier') is-invalid @enderror"
                                            id="employee_tier" placeholder="Posisi Pekerja pengguna"
                                            value="{{ old('employee_tier', $user->employee?->employee_tier) }}"
                                            name="employee_tier">

                                        @error('employee_tier')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="institution">Tempat Pekerja</label>
                                        <input type="text"
                                            class="form-control @error('institution') is-invalid @enderror"
                                            id="institution" placeholder="Tempat Pekerja pengguna"
                                            value="{{ old('institution', $user->employee?->institution) }}"
                                            name="institution">

                                        @error('institution')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="join_date">Tanggal Bergabung</label>
                                        <input type="date"
                                            class="form-control @error('join_date') is-invalid @enderror"
                                            id="join_date" placeholder="Tanggal Bergabung pengguna"
                                            value="{{ old('join_date', $user->employee?->join_date) }}"
                                            name="join_date">

                                        @error('join_date')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="stop_date">Tanggal Keluar</label>
                                        <input type="date"
                                            class="form-control @error('stop_date') is-invalid @enderror"
                                            id="stop_date" placeholder="Tanggal Keluar pengguna"
                                            value="{{ old('stop_date', $user->employee?->stop_date) }}"
                                            name="stop_date">

                                        @error('stop_date')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="length_of_work">Lama Bekerja</label>
                                        <input type="text"
                                            class="form-control @error('length_of_work') is-invalid @enderror"
                                            id="length_of_work" placeholder="Lama Bekerja pengguna (diisi otomatis)"
                                            value="{{ old('length_of_work', $user->employee?->length_of_work) }}"
                                            name="length_of_work" @disabled(true)>

                                        @error('length_of_work')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
