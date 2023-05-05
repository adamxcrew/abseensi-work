@extends('layouts.app')
@section('title', 'Presensi')

@section('title-header', 'Presensi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Presensi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-white">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="card-title h3 text-dark">Presensi Overview</h2>
                            {{-- subtitle --}}
                            <div class="card-subtitle h4 text-muted">
                                {{ date('M Y', strtotime($datePicked)) }}
                            </div>
                        </div>
                        <div class="col text-right">
                            <form action="" method="get">
                                @csrf
                                <div class="form-group w-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control" name="date" placeholder="Select date" type="month"
                                            value="{{ $datePicked }}">
                                    </div>
                                </div>

                                <a class="btn btn-secondary btn-sm" href="{{ route('attendances.index', []) }}">Reset</a>
                                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-md-12">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-dark mb-0">Total Presensi</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $attendanceCount['total'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-12">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-dark mb-0">Hadir</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $attendanceCount['hadir'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-12">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-dark mb-0">Sakit</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $attendanceCount['sakit'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-12">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-dark mb-0">Izin</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $attendanceCount['izin'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-12">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-dark mb-0">Cuti</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $attendanceCount['cuti'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-12">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-dark mb-0">Alpa</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $attendanceCount['alpa'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-white">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="card-title h3 text-dark">All Attendance</h2>
                            {{-- subtitle --}}
                            <div class="card-subtitle h4 text-muted">
                                {{ date('M Y', strtotime($datePicked)) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-flush table-hover" id="table-spp">
                                <thead>
                                    <tr>
                                        <th>Nama Pekerja</th>
                                        @foreach ($datesInThisMonth as $day)
                                            <th>{{ $day }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($attendanceDataByDate) != 0)

                                        @foreach ($employees as $employee)
                                            @forelse ($attendanceDataByDate as $employeeId => $attendance)
                                                @if ($employeeId != $employee->id)
                                                    <tr data-toggle="tooltip" data-placement="right" title="{{ $employee->user->fullname }}">
                                                        <td>{{ $employee->user->fullname }}</td>
                                                        @foreach ($datesInThisMonth as $day)
                                                            <td>
                                                                {{ $attendance[$day] ?? '-' }}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="{{ count($datesInThisMonth) }}">No Data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
