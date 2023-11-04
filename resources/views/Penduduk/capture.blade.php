@extends('layouts.master')

@section('title', 'Verifikasi Penduduk')
@section('header', 'Verifikasi Penduduk')
@section('breadcrumb', 'Verifikasi Penduduk')
@section('container-fluid')
    <style>
        .vidio-container{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            /* Sesuaikan dengan kebutuhan Anda */
        }

        #webcam {
            width: 100%;
            /* Agar video menutupi seluruh lebar card */
            max-width: 600px;
            /* Sesuaikan dengan kebutuhan Anda */
        }

        #captureButton {
            margin-top: 10px;
            /* Sesuaikan dengan kebutuhan Anda */
        }
    </style>
    <div class="container">

        <div class="card">
            <div class="card-header">
                @foreach ($capture as $item)
                    <p class="fw-bold text-center ">{{ $item->nama }}-{{ $item->nik }}</p>
                @endforeach
            </div>
            <div class="card-body">
                <div class="vidio-container">
                    <input class="form-control mb-5" type="text" id="nik_penduduk" value="{{ request()->segment(2) }}"
                        name="nik_penduduk" placeholder="Nomor NIK Penduduk" hidden>
                    <video id="webcam" class="mx-auto" autoplay></video>
                    <canvas id="canvas" style="display: none"></canvas>
                    <img id="capturedImage" style="display: none;">
                    <button class="btn btn-success mt-5" id="captureButton">Capture Image</button>
                </div>
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

            captureButton.addEventListener('click', function(e) { // Tambahkan e sebagai parameter
                canvas.style.display = 'block';
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                capturedImage.src = canvas.toDataURL('image/png');
                capturedImage.style.display = 'none';

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
                        window.location = '/capture';
                        console.log(response);
                    }
                });
                e.stopImmediatePropagation();
            });
        });
    </script>

@endsection
