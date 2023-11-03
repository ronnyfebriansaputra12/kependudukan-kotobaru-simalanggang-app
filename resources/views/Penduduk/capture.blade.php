@extends('layouts.master')

@section('title', 'Verifikasi Penduduk')
@section('header', 'Verifikasi Penduduk')
@section('breadcrumb', 'Verifikasi Penduduk')

@section('container-fluid')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Penduduk
            </div>
            <div class="card-body">
                {{-- @php
                    dd($capture);
                @endphp --}}



                <input type="text" id="nik_penduduk" value="{{ request()->segment(2) }}" name="nik_penduduk"
                    placeholder="Nomor NIK Penduduk">
                <video id="webcam" autoplay></video>
                <canvas id="canvas" style="display: none"></canvas>
                <img id="capturedImage" style="display: none;">
                <button id="captureButton">Capture Image</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const video = document.getElementById('webcam');
            const canvas = document.getElementById('canvas');
            const capturedImage = document.getElementById('capturedImage');
            const captureButton = document.getElementById('captureButton');

            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(error) {
                    console.log('Error accessing webcam: ' + error);
                });

            captureButton.addEventListener('click', function() {
                canvas.style.display = 'block';
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                capturedImage.src = canvas.toDataURL('image/png');
                capturedImage.style.display = 'block';

                $.ajax({
                    type: 'POST',
                    url: '/simpan-gambar',
                    data: {
                        file_gambar: capturedImage.src,
                        nik_penduduk: $('#nik_penduduk').val()
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });
                e.stopImmediatePropagation();
            });
        });
    </script>
@endsection
