@extends('layouts.app')
@section('title', 'User Logs')

@section('title-header', 'User Logs')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">User Logs</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">User Logs</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Log</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($userLogs as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->user_log == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif ($user->user_log == 'approved')
                                                <span class="badge badge-success">Approved</span>
                                            @else
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td class="d-flex jutify-content-center">
                                            <form id="approve-form-{{ $user->id }}" action="{{ route('user-logs.update', $user->id) }}" class="d-none" method="post">
                                                @csrf
                                                @method('put')
                                            </form>
                                            <button onclick="approveForm('{{$user->id}}')" class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>

                                            <form id="reject-form-{{ $user->id }}" action="{{ route('user-logs.destroy', $user->id) }}" class="d-none" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="deleteForm('{{$user->id}}')" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Tidak ada permintaan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">
                                        {{ $userLogs->links() }}
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
        function approveForm(id){
            Swal.fire({
                title: 'Terima permintaan',
                text: "Anda akan menerima permintaan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(`#approve-form-${id}`).submit()
                }
            })
        }

        function deleteForm(id){
            Swal.fire({
                title: 'Tolak permintaan',
                text: "Anda akan menolak permintaan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(`#reject-form-${id}`).submit()
                }
            })
        }
    </script>
@endsection
