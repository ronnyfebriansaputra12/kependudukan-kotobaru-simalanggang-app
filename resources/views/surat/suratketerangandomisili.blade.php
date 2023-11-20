<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="{{ asset('kota-pariaman.png') }}" />
    <title>Surat Keterangan Domisili</title>
    <style>
        /* Gaya untuk elemen-elemen surat */
        body {
            font-family: "Times New Roman", Times, serif;
            width: 700px;
            font-size: 12pt;
            height: 544px;
            padding: 38px 76px 26px 95px;
        }

        .container {
            width: 100%;
            margin: auto;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 4px solid #000;
            /* Atur warna dan ukuran garis sesuai preferensi Anda */
            padding-bottom: 5px;
            /* Berikan sedikit jarak antara header dan konten di bawahnya */
            margin-bottom: 25px;
        }

        .brand-image {
            float: left;
            margin-right: 10px;
            height: 100px;
        }

        h3 {
            margin: 0;
            text-align: center;
        }

        h2 {
            margin: 0;
            text-align: center;
        }

        .content {
            font-size: 12pt;
        }

        /* Tambahkan gaya lainnya sesuai kebutuhan Anda */
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('AdminLTE') }}/dist/img/50kota.png" alt="Kota Pariaman" class="brand-image">

            <div class="header-content" style="text-align: center; margin-left: 50px">
                <h2>PEMERINTAH KOTA PAYAKUMBUH</h2>
                <h2>KECAMATAN PAYAKUMBUH</h2>
                <h2>KANTOR NAGARI SIMALANGGANG </h2>
                <p style="margin: 0;"><b>Jln Wr Soepratman Desa Apar Kode Pos: 25522</b></p>
            </div>
        </div>

        <div class="content">
            @php
                use Carbon\Carbon;
            @endphp
            @if ($pengajuan->count() > 0)
                @php
                    $firstPengajuan = $pengajuan->first();
                    $penduduk = $firstPengajuan->penduduk; // Akses objek Penduduk
                @endphp
                <p style="text-align: center; font-weight: bold; text-decoration: underline; margin-bottom: -14px">
                    SURAT KETERANGAN DOMISILI
                </p>
                <p style="text-align: center;margin-bottom: 40px;">
                    <b>Nomor :   /SKD/ NG-SMG /VIII/2023</b>
                </p>
                <div style="text-indent: 30px">
                    <p>Yang bertanda tangan dibawah ini
                        Kepala
                        Nagari Simalanggang Kecamatan Payakumbuh Kabupaten Lima Puluh Kota Provinsi Sumatera Barat.
                        Menyatakan bahwa :</p><br>
                    <table class="table" >
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><b>{{ ucwords(strtolower($penduduk->nama)) }}</b></td>
                        </tr>

                        <tr>

                            <td>Tempat/Tgl Lahir</td>
                            <td>:</td>
                            <td>{{ ucwords(strtolower($penduduk->tmp_lahir)) }}/{{ Carbon::parse($penduduk->tgl_lahir)->isoFormat('D MMMM Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>
                                @if ($penduduk->jekel === 'Laki-laki')
                                    Laki-laki
                                @elseif ($penduduk->jekel === 'Perempuan')
                                    Perempuan
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>{{ ucwords(strtolower($penduduk->agama)) }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td>{{ ucwords(strtolower($penduduk->pekerjaan)) }}</td>
                        </tr>
                        <tr>
                            <td>Alamat Domisili</td>
                            <td>:</td>
                            <td>{{ ucwords(strtolower($penduduk->alamat)) }}</td>
                        </tr>
                        <!-- Sisanya dari kode Anda -->

                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>

                    </table>
                </div>

                <br>
                <div style="text-align: justify; text-indent: 30px">

                    <p>Menurut sepengetahuan kami bahwa yang
                        namanya diatas memang benar warga bermodimisli di Nagari Simalanggang Kecamatan Payakumbuh </p>

                    <p>Demikian surat keterangan domisili
                        ini
                        kami buat, unutk dapat dipergunakan sebagaimana perlunya
                    </p>
                </div>
                <div style="text-align: right; margin-top: 30px">
                    @php
                        $englishMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                        $indonesianMonths = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        $currentMonthIndex = date('n') - 1; // January is 1, so we subtract 1 to get the correct index
                        $indonesianMonth = $indonesianMonths[$currentMonthIndex];
                    @endphp

                    <p>Koto Baru, {{ date('d', time()) }} {{ $indonesianMonth }} {{ date('Y', time()) }}</p>

                    <p style="margin-bottom: 60px">Kepala Desa Koto baru</p>
                    {{-- <img src="{{ asset('ttd-kepsek.png') }}" alt="Kota Pariaman"
                        style="margin-right: 35px;width: 120px; height: 100px;"> --}}
                    <p style="font-weight: bold">Rezki Yuanda Putra</p>
                </div>
            @endif
        </div>
    </div>
</body>

</html>
<script>
    window.print();
    // When printing is done, navigate back
    window.onafterprint = function() {
        window.history.back();
    };
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var namaElement = document.getElementById("formattedNama");

        if (namaElement) {
            console.log("Script dijalankan!");
            namaElement.innerText = namaElement.innerText.toLowerCase().replace(/\b\w/g, function(l) {
                return l.toUpperCase()
            });
        } else {
            console.log("Elemen dengan ID formattedNama tidak ditemukan.");
        }
    });
</script>
