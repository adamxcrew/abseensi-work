@extends('layouts.app')
@section('title', 'Dashboard')
@php
    $auth = Auth::user();
@endphp

@section('action_btn')
<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary btnReport shadow-sm"><i
    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        @if (!$hasScheduleToday && Auth::user()->role != 'admin')
                <div class="alert alert-danger" role="alert">
                    <strong>Warning!</strong> Anda belum absen masuk hari ini.
                </div>
                <div class="mb-3 mt-3">
                    <form action="{{ route('presences.create') }}" method="post">
                        @csrf

                        <button type="submit" class="btn btn-primary w-100" name="presences_type" value="absen_masuk">Absen
                            Masuk</button>
                    </form>
                </div>
            @elseif ($hasScheduleToday && Auth::user()->role != 'admin' && !$hasScheduleToday->clock_out)
                <div class="alert alert-danger" role="alert">
                    <strong>Warning!</strong> Anda belum absen keluar hari ini.
                </div>
                <div class="mb-3 mt-3">
                    <form action="{{ route('presences.create') }}" method="post">
                        @csrf

                        <button type="submit" class="btn btn-primary w-100" name="presences_type"
                            value="absen_keluar">Absen
                            Keluar</button>
                    </form>
                </div>
            @endif

       <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-dashboard border-left-primary shadow-card">
             <div class="body-card">
                <div class="row no-gutters align-items-center">
                   <div class="col adjust-card">
                      <div class="text-md label-dashboard">
                         Total Absensi
                         <div class="mini-label dateLocal">
                            {{ $datePickedFormated }}
                         </div>
                      </div>
                      <button class="h3 mb-0 text-primary label-angka" data-toggle="modal"
                         data-target="#modalTerlambat">{{ $attendanceCount['total'] }}</button>
                      <div class="text-md mb-0 label-dashboard-bawah">Pegawai</div>
                   </div>
                   <div class="col-auto adjust-chart">
                      <canvas id="myPieChart" width="100%" height="90"></canvas>
                   </div>
                </div>
             </div>
          </div>
       </div>

       <!-- START MODAL TERLAMBAT -->
       <div class="modal fade" id="modalTerlambat" aria-hidden="true" aria-labelledby="modalTerlambatLabel">
          <div class="modal-dialog modal-xl">
             <div class="modal-content">
                <div class="modal-header">
                   <div class="col">
                      <h5 class="modal-title text-center dateLocalTerlambat" id="modalToggleLabel">
                         {{ $datePickedFormated }}
                      </h5>
                   </div>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                   <table class="table table-hover">
                      <thead>
                         <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Posisi Pekerjaan</th>
                         </tr>
                      </thead>
                      <tbody>

                         <tr>
                            <td>1</td>
                            <td>Maman Sutardi</td>
                            <td>Finance</td>
                            <td>Junior Staff</td>
                         </tr>

                         <tr>
                            <td>2</td>
                            <td>Ascelion Susanto</td>
                            <td>Sales</td>
                            <td>Sales Manager</td>
                         </tr>

                         <tr>
                            <td>3</td>
                            <td>Michael Winalian</td>
                            <td>Developer</td>
                            <td>Senior Backend Developer</td>
                         </tr>

                      </tbody>
                   </table>
                </div>
             </div>
          </div>
       </div>
       <!-- END MODAL TERLAMBAT -->


       <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-dashboard border-left-primary shadow-card">
             <div class="body-card">
                <div class="row no-gutters align-items-center">
                   <div class="col adjust-card">
                      <div class="text-md label-dashboard">
                         Tidak Hadir
                         <div class="mini-label dateLocal">
                            {{ $datePickedFormated }}
                         </div>
                      </div>
                      <button class="h3 mb-0 text-primary label-angka" data-toggle="modal"
                         data-target="#modalTidakHadir">{{ $attendanceCount['alpa'] }}</button>
                      <div class="text-md mb-0 label-dashboard-bawah">Pegawai</div>
                   </div>
                   <div class="col-auto adjust-chart">
                      <canvas id="myPieChart1" width="100%" height="90"></canvas>
                   </div>
                </div>
             </div>
          </div>
       </div>

       <!-- START MODAL TIDAK HADIR -->
       <div class="modal fade" id="modalTidakHadir" aria-hidden="true" aria-labelledby="modalTidakHadirLabel">
          <div class="modal-dialog modal-xl">
             <div class="modal-content">
                <div class="modal-header">
                   <div class="col">
                      <h5 class="modal-title text-center dateLocalTidakHadir" id="modalToggleLabel">
                         <?= date('d F Y ') ?>
                      </h5>
                   </div>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                   <table class="table table-hover">
                      <thead>
                         <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Posisi Pekerjaan</th>
                         </tr>
                      </thead>
                      <tbody>

                         <!-- DUMMYS DATA -->

                         <tr>
                            <td>1</td>
                            <td>Bambang Sutrisno</td>
                            <td>Finance</td>
                            <td>Senior Sales</td>
                         </tr>

                         <tr>
                            <td>2</td>
                            <td>Erika Manopo</td>
                            <td>HR</td>
                            <td>Recruitment Staff</td>
                         </tr>

                         <tr>
                            <td>3</td>
                            <td>Jerhemy Owen</td>
                            <td>Developer</td>
                            <td>Junior Frontend Developer</td>
                         </tr>

                         <tr>
                            <td>4</td>
                            <td>Christoffel Lunar</td>
                            <td>Marketing</td>
                            <td>Marketing Manager</td>
                         </tr>

                         <tr>
                            <td>5</td>
                            <td>Hans Christian Sugijanto</td>
                            <td>Developer</td>
                            <td>Fullstack Developer</td>
                         </tr>

                         <tr>
                            <td>6</td>
                            <td>Eko Setyono Wibowo</td>
                            <td>Developer</td>
                            <td>Junior Engineer</td>
                         </tr>

                         <tr>
                            <td>7</td>
                            <td>Xaverius Andrea</td>
                            <td>Produksi</td>
                            <td>Supervisor</td>
                         </tr>

                         <tr>
                            <td>8</td>
                            <td>Agus Susanto</td>
                            <td>Produksi</td>
                            <td>Operator</td>
                         </tr>

                         <tr>
                            <td>9</td>
                            <td>Yuma Soerianto</td>
                            <td>Developer</td>
                            <td>Product Manager</td>
                         </tr>

                         <tr>
                            <td>10</td>
                            <td>Marteen Suteja</td>
                            <td>Marketing</td>
                            <td>Marketing Manager</td>
                         </tr>

                      </tbody>
                   </table>
                </div>
             </div>
          </div>
       </div>
       <!-- END MODAL TIDAK HADIR -->


       <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-dashboard border-left-primary shadow-card">
             <div class="body-card">
                <div class="row no-gutters align-items-center">
                   <div class="col adjust-card">
                      <div class="text-md label-dashboard">
                         Cuti
                         <div class="mini-label dateLocal">
                            {{ $datePickedFormated }}
                         </div>
                      </div>
                      <button class="h3 mb-0 text-primary label-angka" data-toggle="modal"
                         data-target="#modalCuti">{{ $attendanceCount['cuti'] }}</button>
                      <div class="text-md mb-0 label-dashboard-bawah">Pegawai</div>
                   </div>
                   <div class="col-auto adjust-chart">
                      <canvas id="myPieChart2" width="100%" height="90"></canvas>
                   </div>
                </div>
             </div>
          </div>
       </div>

       <!-- START MODAL CUTI -->
       <div class="modal fade" id="modalCuti" aria-hidden="true" aria-labelledby="modalCutiLabel">
          <div class="modal-dialog modal-xl">
             <div class="modal-content">
                <div class="modal-header">
                   <div class="col">
                      <h5 class="modal-title text-center dateLocalCuti" id="modalToggleLabel">
                         {{ $datePickedFormated }}
                      </h5>
                   </div>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                   <table class="table table-hover">
                      <thead>
                         <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Posisi Pekerjaan</th>
                         </tr>
                      </thead>
                      <tbody>

                         <!-- DUMMYS DATA -->

                         <tr>
                            <td>1</td>
                            <td>Kezia Lizina</td>
                            <td>Finance</td>
                            <td>Senior Sales</td>
                         </tr>

                         <tr>
                            <td>2</td>
                            <td>Erika Manopo</td>
                            <td>HR</td>
                            <td>Recruitment Staff</td>
                         </tr>

                         <tr>
                            <td>3</td>
                            <td>Brandon Soekresno</td>
                            <td>Developer</td>
                            <td>Junior Frontend Developer</td>
                         </tr>

                         <tr>
                            <td>4</td>
                            <td>Adelya Salsa</td>
                            <td>Marketing</td>
                            <td>Marketing Manager</td>
                         </tr>

                         <tr>
                            <td>5</td>
                            <td>Vincent Sugijanto</td>
                            <td>Developer</td>
                            <td>Fullstack Developer</td>
                         </tr>

                      </tbody>
                   </table>
                </div>
             </div>
          </div>
       </div>
       <!-- END MODAL CUTI -->

       <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-dashboard border-left-primary shadow-card">
             <div class="body-card">
                <div class="row no-gutters align-items-center">
                   <div class="col adjust-card">
                      <div class="text-md label-dashboard">
                         Dinas Luar
                         <div class="mini-label dateLocal">
                            {{ $datePickedFormated }}
                         </div>
                      </div>
                      <button class="h3 mb-0 text-primary label-angka" data-toggle="modal"
                         data-target="#modalDinasLuar">5</button>
                      <div class="text-md mb-0 label-dashboard-bawah">Pegawai</div>
                   </div>
                   <div class="col-auto adjust-chart">
                      <canvas id="myPieChart3" width="100%" height="90"></canvas>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>

    <!-- START MODAL DINAS LUAR -->
    <div class="modal fade" id="modalDinasLuar" aria-hidden="true" aria-labelledby="modalDinasLuarLabel">
       <div class="modal-dialog modal-xl">
          <div class="modal-content">
             <div class="modal-header">
                <div class="col">
                   <h5 class="modal-title text-center dateLocalDinasLuar" id="modalToggleLabel">
                      {{ $datePickedFormated }}
                   </h5>
                </div>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">

                <table class="table table-hover">
                   <thead>
                      <tr>
                         <th scope="col">No</th>
                         <th scope="col">Nama</th>
                         <th scope="col">Divisi</th>
                         <th scope="col">Posisi Pekerjaan</th>
                      </tr>
                   </thead>
                   <tbody>

                      <!-- DUMMYS DATA -->

                      <tr>
                         <td>1</td>
                         <td>Felice Chrismarry Lu</td>
                         <td>Finance</td>
                         <td>Senior Sales</td>
                      </tr>

                      <tr>
                         <td>2</td>
                         <td>Oza Rangkuti</td>
                         <td>HR</td>
                         <td>Recruitment Staff</td>
                      </tr>

                      <tr>
                         <td>3</td>
                         <td>Yurino Putra Angkawijaya</td>
                         <td>Developer</td>
                         <td>Junior Frontend Developer</td>
                      </tr>

                      <tr>
                         <td>4</td>
                         <td>Eko Julianto</td>
                         <td>Marketing</td>
                         <td>Marketing Manager</td>
                      </tr>

                      <tr>
                         <td>5</td>
                         <td>Edwin Darmawan</td>
                         <td>Developer</td>
                         <td>Fullstack Developer</td>
                      </tr>

                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
    <!-- END MODAL DINAS LUAR -->


    <!-- Content Row -->
    <div class="row">

       <!-- Area Chart -->
       <div class="col-xl-8 col-lg-7">
          <div class="d-flex justify-content-between">
             <h6 class="label-card">Tingkatan Pegawai</h6>
             <!-- <h6 class="label-card2">Lihat</h6> -->
          </div>
          <div class="card shadow-card mb-4">
             <!-- Card Header - Dropdown -->
             <!-- Card Body -->
             <div class="card-body mb-2">
                <div class="row">
                   <div class="col">
                      <p>Guru</p>
                      <p>Tata Usaha</p>
                      <p>Admin</p>
                   </div>
                   <div class="col">
                      <p>{{$officerLevelData['teacher']['total']}} Pegawai</p>
                      <p>{{$officerLevelData['tu']['total']}} Pegawai</p>
                      <p>{{$officerLevelData['admin']['total']}} Pegawai</p>
                   </div>
                   <div class="col">
                      <p>{{ $officerLevelData['teacher']['persentase'] }}%</p>
                      <p>{{ $officerLevelData['tu']['persentase'] }}%</p>
                      <p>{{ $officerLevelData['admin']['persentase'] }}%</p>
                   </div>
                   <div class="col">
                      <div class="progress mb-4 pointer" data-toggle="tooltip" data-placement="right"
                         title="Guru : {{ $officerLevelData['teacher']['total'] }}">
                         <div class="progress-bar bg-red" role="progressbar" style="width: {{ $officerLevelData['teacher']['persentase'] }}%" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                      <div class="progress mb-4 pointer" data-toggle="tooltip" data-placement="right"
                         title="Tata Usaha : {{ $officerLevelData['tu']['total'] }}">
                         <div class="progress-bar bg-green" role="progressbar" style="width: {{ $officerLevelData['tu']['persentase'] }}%" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                      <div class="progress mb-4 pointer" data-toggle="tooltip" data-placement="right"
                         title="Admin : {{ $officerLevelData['admin']['total'] }}">
                         <div class="progress-bar bg-blue" role="progressbar" style="width: {{ $officerLevelData['admin']['persentase'] }}%" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>

       <!-- Pie Chart -->
       <div class="col-xl-4 col-lg-5">
          <div class="d-flex justify-content-between">
             <h6 class="label-card">Status Pegawai</h6>
             <!-- <h6 class="label-card2">Lihat</h6> -->
          </div>
          <div class="card shadow-card">
             <!-- Card Header - Dropdown -->
             <!--  -->
             <!-- Card Body -->
             <div class="card-body">
                <div class="row">
                   <div class="col-md-9">
                      <div class="progress mb-4 pointer" data-toggle="tooltip" data-placement="top"
                         title="Permanen : {{ $statsOfficerData['tetap']['total'] }}">
                         <div class="progress-bar bg-blue" id="bar-permanen" role="progressbar" style="width: {{ $statsOfficerData['tetap']['persentase'] }}%"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                         </div>
                      </div>
                      <div class="progress mb-4 pointer" data-toggle="tooltip" data-placement="right"
                         title="Percobaan : {{ $statsOfficerData['kontrak']['total'] }}">
                         <div class="progress-bar bg-green" role="progressbar" style="width: {{ $statsOfficerData['kontrak']['persentase'] }}%" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                   </div>
                   <div class="col-md-3">
                      <p class="label-persen-chart">{{ $statsOfficerData['tetap']['persentase'] }}%</p>
                      <p class="label-persen-chart">{{ $statsOfficerData['kontrak']['persentase'] }}%</p>
                   </div>
                </div>
                <div class="row">
                   <div class="d-flex justify-content-between">
                      <h5 class="body-text"><i class="fas fa-circle text-primary"></i> Permanen</h5>
                      <h5 class="body-text"><i class="fas fa-circle text-success"></i> Percobaan</h5>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>

    <!-- Content Row -->
    <div class="row">

       <!-- Content Column -->
       <div class="col-xl-4 col-lg-5">
          <div class="d-flex justify-content-between">
             <h6 class="label-card">Jenis Kelamin Pegawai</h6>
             <!-- <h6 class="label-card2">Lihat</h6> -->
          </div>
          <!-- Project Card Example -->
          <div class="card shadow-card mb-4">
             <!-- CARD HEADER -->
             <!--  -->
             <!-- CARD BODY -->
             <div class="card-body">
                <canvas id="gendersChart" width="200%" height="300"></canvas>
             </div>
             <div class="small text-center adjust-legend">
                <span class="mx-3">
                   <i class="fas fa-circle bg-green"></i> {{ $gendersOfficerData['male']['persentase'] }}%
                </span>
                <span class="mx-3">
                   <i class="fas fa-circle bg-yellow"></i> {{ $gendersOfficerData['female']['persentase'] }}%
                </span>

             </div>
          </div>

       </div>

       <div class="col-xl-8 col-lg-7">
          <div class="d-flex justify-content-between">
             <h6 class="label-card">Total Pegawai</h6>
             <!-- <h6 class="label-card2">Lihat</h6> -->
          </div>
          <div class="card shadow-card mb-4">
             <!-- Card Header - Dropdown -->
             <!--  -->
             <!-- Card Body -->
             <div class="card-body adjust-legend">
                <div class="chart-area">
                   <div id="myChart" style="width: 100%; height: 400px;"></div>
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
                                        @foreach ($attendanceDataByDate as $employeeName => $attendanceData)
                                            <tr>
                                                <td>{{ $employeeName }}</td>
                                                @foreach ($datesInThisMonth as $day)
                                                    <td>
                                                        {{ $attendanceData[$day] ?? '-'  }}
                                                    </td>
                                                @endforeach
                                            </tr>
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script>
    var gendersOfficerData = @json($gendersOfficerData);
</script>
<script type="text/javascript">
   Highcharts.chart('myChart', {
      chart: {
         type: 'column'
      },
      title: {
         text: 'Total Pegawai SMK Wikrama Bogor'
      },
      xAxis: {
         categories: ['Januari', 'Februari', 'Maret',]
      },
      yAxis: {
         title: {
            text: 'Jumlah'
         }
      },
      plotOptions: {
         column: {
            pointWidth: 30
         }
      },
      series: [{
         name: 'Data 1',
         color: '#165C9E',
         data: [49.9, 71.5, 106.4]
      }]
   });

   var ctx = document.getElementById("gendersChart");
    var myDoughChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Laki - laki", "Perempuan"],
        datasets: [{
        data: [gendersOfficerData.male.total, gendersOfficerData.female.total,],
        backgroundColor: ['#4CAF50', '#FFC107'],
        hoverBackgroundColor: ['#4CAF50', '#FFC107'],
        hoverBorderColor: ['#4CAF50', '#FFC107'],
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        },
        legend: {
        display: true
        },
        cutoutPercentage: 80,
    },
    });
</script>
@endsection
