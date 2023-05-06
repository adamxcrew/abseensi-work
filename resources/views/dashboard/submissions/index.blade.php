@extends('layouts.app')
@section('title', 'Submissions')

@section('title-header', 'Submissions')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Submissions</li>
@endsection

@section('action_btn')
    <a href="{{route('submissions.create')}}" class="btn btn-default">Tambah Data</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Submissions</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Employee Name</th>
                                    <th>Start Timeoff</th>
                                    <th>End Timeoff</th>
                                    <th>Type Timeoff</th>
                                    <th>Status Timeoff</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($submissions as $submission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $submission->employee?->user?->fullname }}</td>
                                        <td>{{ $submission->start_timeoff }}</td>
                                        <td>{{ $submission->finish_timeoff }}</td>
                                        <td>{{ $submission->timeoff->description_timeoff }} <div class="text-uppercase">({{ $submission->timeoff->code_timeoff }})</div></td>
                                        <td>
                                            @if ($submission->submission_status == 'pending')
                                                <span class="badge badge-warning">{{ $submission->submission_status }}</span>
                                            @elseif ($submission->submission_status == 'approved')
                                                <span class="badge badge-success">{{ $submission->submission_status }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $submission->submission_status }}</span>
                                            @endif
                                        </td>
                                        <td class="d-flex jutify-content-center">
                                            <a href="{{route('submissions.show', ['submission' => $submission->uuid])}}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                            <form id="delete-form-{{ $submission->uuid }}" action="{{ route('submissions.destroy', ['submission' => $submission->uuid]) }}" class="d-none" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="deleteForm('{{$submission->uuid}}')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
                                        {{ $submissions->links() }}
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
        function deleteForm(uuid){
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
                    $(`#delete-form-${uuid}`).submit()
                }
            })
        }
    </script>
@endsection
