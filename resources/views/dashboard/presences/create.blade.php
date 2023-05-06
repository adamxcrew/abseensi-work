@extends('layouts.app')
@section('title', 'Input Presensi')

@section('title-header', 'Input Presensi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Input Presensi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                Klik tombol <strong>Start</strong> untuk mengaktifkan kamera dan tunggu hingga 5 detik untuk mengambil
                gambar untuk absensi.
            </div>
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <div class="webcam">
                        <div class="video-outer">
                            <video id="video" height="100%" width="100%" autoplay></video>
                        </div>

                        <div class="webcam-start-stop">
                            <button class="btn btn-primary" onclick="start()">Start</button>
                            <a href="{{ route('home', []) }}" class="btn btn-danger">Batalkan Absensi</a>
                        </div>
                    </div>

                    <form class="d-none" id="form-post-image" action="{{ route('presences.post-image', []) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="attendance_image" id="attendance_image" value="">
                        <input type="text" name="attendance_longitude_lat" id="attendance_longitude_lat" value="">
                        <input type="hidden" name="attendance_date_clock" id="attendance_date_clock"
                        value="{{ date('Y-m-d H:i:s') }}">
                        <input type="text" name="presences_type" id="presences_type" value="{{ $presences_type }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var StopWebCam = function() {
            var stream = video.srcObject;
            var tracks = stream.getTracks();

            for (var i = 0; i < tracks.length; i++) {
                var track = tracks[i];
                track.stop();
            }
            video.srcObject = null;
        }

        var start = function() {
            var video = document.getElementById("video"),
                vendorURL = window.URL || window.webkitURL;

            if (navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                        video: true
                    })
                    .then(function(stream) {
                        video.srcObject = stream;

                        // alert the user if the browser is not supporting the webcam
                        video.onerror = function() {
                            alert("Please allow access to the webcam");
                        };

                        // submit the form when the video stream is loaded and set values for the hidden fields delay 5 seconds
                        video.onloadedmetadata = function() {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                document.getElementById("attendance_longitude_lat").value = position
                                    .coords.latitude + " " + position.coords.longitude;
                                    console.log(position.coords.latitude + " " + position.coords.longitude);
                            });


                            setTimeout(function() {
                                var canvas = document.createElement("canvas");
                                canvas.width = video.videoWidth;
                                canvas.height = video.videoHeight;
                                canvas.getContext("2d").drawImage(video, 0, 0);
                                var img = canvas.toDataURL("image/png");
                                document.getElementById("attendance_image").value = img;

                                document.getElementById("form-post-image").submit();
                            }, 5000);
                        };

                    }).catch(function(error) {
                        console.log("Something went wrong");
                    });
            }
        }
    </script>
@endsection
