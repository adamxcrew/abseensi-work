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
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Presensi</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pekerja</th>
                                    <th>Tanggal Presensi</th>
                                    <th>Deskripsi Presensi</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Lokasi Masuk</th>
                                    <th>Lokasi Keluar</th>
                                    <th>Foto Presensi Masuk</th>
                                    <th>Foto Presensi Keluar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendances as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->employee->user->fullname }}</td>
                                        <td>{{ $user->presence_date }}</td>
                                        <td>{{ $user->presence_status }}</td>
                                        <td>{{ $user->presence_desc }}</td>
                                        <td>{{ $user->clock_in }}</td>
                                        <td>{{ $user->clock_out }}</td>
                                        <td>{{ $user->location_in }}</td>
                                        <td>{{ $user->location_out }}</td>
                                        <td>{{ $user->presence_pict_in }}</td>
                                        <td>{{ $user->presence_pict_out }}</td>
                                        <td class="d-flex jutify-content-center">
                                            <a href="{{route('attendances.edit', $user->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('attendances.destroy', $user->id) }}" class="d-none" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="deleteForm('{{$user->id}}')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
                                        {{ $attendances->links() }}
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

@section('script')
    <script>
        function deleteForm(id){
            Swal.fire({
                title: 'Hapus data',
                text: "Anda akan menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit()
                }
            })
        }
    </script>
@endsection
