@extends('layouts.master')

@section('title', 'Verifikasi Penduduk')
@section('header', 'Verifikasi Penduduk')
@section('link')
    <a href="{{ url('penduduk') }}">Penduduk</a>
@endsection
@section('breadcrumb', 'Verifikasi Penduduk')
@section('container-fluid')
    <style>
        .vidio-container {
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
                    <input class="form-control mb-2" type="text" id="nik_penduduk" value="{{ request()->segment(2) }}"
                        name="nik_penduduk" placeholder="Nomor NIK Penduduk" hidden>
                    <video id="webcam" class="mx-auto" autoplay></video>
                    <canvas id="canvas" style="display: none" class="mt-3"></canvas>
                    <img id="capturedImage" style="display: none;">
                    <div class="d-flex">
                        <button class="btn btn-primary mt-2 mr-1" id="captureButton" title="Ambil Foto">
                            <li class="fas fa-camera"></li>
                        </button>
                        <a href="{{ url('capture') }}" class="btn btn-success mt-2 mr-1" title="Simpan Gambar">
                            <li class="fas fa-save"></li>
                        </a>
                        <form action="{{ url('capture-delete/' . request()->segment(2)) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger mt-2" title="Reset"><i class="fas fa-sync-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const video = document.getElementById('webcam');
            const canvas = document.getElementById('canvas');

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

            captureButton.addEventListener('click', function(e) {
                canvas.style.display = 'block';
                canvas.width = 650;
                canvas.height = 500;
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                capturedImage.src = canvas.toDataURL('image/png');
                capturedImage.style.display = 'none';

                // Hide the video element
                video.style.display = 'none';

                // Convert canvas content to Blob
                canvas.toBlob(function(blob) {
                    const formData = new FormData();
                    formData.append('image', blob, 'image.png');

                    $.ajax({
                        type: 'POST',
                        url: '/simpan-gambar',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Handle success
                            console.log(response);
                        },
                        error: function(error) {
                            // Handle error
                            console.log(error);
                        }
                    });
                }, 'image/png');

                e.stopImmediatePropagation();
            });
        });
    </script>
    {{-- <script>
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


            captureButton.addEventListener('click', function(e) {
                canvas.style.display = 'block';
                canvas.width = 650;
                canvas.height = 500;
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                capturedImage.src = canvas.toDataURL('image/png');
                capturedImage.style.display = 'none';

                // Hide the video element
                video.style.display = 'none';

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
                        // window.location = '/capture';
                        // console.log(response);
                    }
                });
                e.stopImmediatePropagation();
            });
        });
    </script> --}}


@endsection
