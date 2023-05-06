@extends('layouts.app')
@section('title', 'Submission Conditional')

@section('title-header', 'Submission Conditional')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Submission Conditional</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Submission Conditional</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Cuti</th>
                                    <th>Deskripsi Cuti</th>
                                    <th>Kode Cuti</th>
                                    <th>Durasi Cuti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($timeoff as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->jenis_timeoff }}</td>
                                        <td>{{ $user->description_timeoff }}</td>
                                        <td class="text-uppercase">
                                            {{ $user->code_timeoff }}
                                        </td>
                                        <td>
                                            {{ $user->durasi_timeoff }} Hari
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">
                                        {{ $timeoff->links() }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
