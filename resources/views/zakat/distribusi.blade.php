<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pendistribusian Zakat Al-Maghfiroh dari {{ \Carbon\Carbon::parse($dari_tanggal)->isoFormat('
        DD MMMM Y') }} sampai {{ \Carbon\Carbon::parse($sampai_tanggal)->isoFormat('
        DD MMMM Y') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        .mt-10 {
            margin-top: -10px;
        }

        .mt-20 {
            margin-top: -20px;
        }

        .mt_10 {
            margin-top: 10px;
        }

        .mt_40 {
            margin-top: -40px;
        }

        .fs-15 {
            font-size: 13px;
        }

        .fs-14 {
            font-size: 12px;
        }

        .fs-12 {
            font-size: 10px;
        }

        .td-1 {
            width: 1%;
        }

        .td-5 {
            width: 5%;
        }

        .td-10 {
            width: 10%;
        }

        .td-15 {
            width: 15%;
        }

        .td-20 {
            width: 20%;
        }

        .td-25 {
            width: 25%;
        }

        .td-50 {
            width: 50%;
        }

        .td-75 {
            width: 75%;
        }
    </style>

    <table class="table table-borderless">
        <tbody>
            <tr>
                <td class="td-5"><img style="width: 100px;display:inline;"
                        src="{{ public_path('assets/images/logo/logo.png') }}" alt=""></td>
                <td class="td-50">
                    <h5 class="fs-15">PANITIA / AMIL ZAKAT</h5>
                    <h5 class="mt-10 fs-15">MASJID AL-MAGHFIROH</h5>
                    <p class="mt-10 fs-12"><u>Jl. Kp. Wonosari RT 2 / IV TPI</u></p>
                </td>
            </tr>

        </tbody>
    </table>

    <center>
        <h5>Laporan Pendistribusian Zakat Al-Maghfiroh dari {{ \Carbon\Carbon::parse($dari_tanggal)->isoFormat('
            DD MMMM Y') }} sampai {{ \Carbon\Carbon::parse($sampai_tanggal)->isoFormat('
            DD MMMM Y') }} </h5>
    </center>

    <table class='table table-bordered mb-2'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Total Uang (Rp)</th>
                <th>Total Beras (Kg)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penerima as $pen)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pen->nama }}</td>
                <td>{{ $pen->golongan->kategori }}</td>
                <td>@format_angka(round($pen->zakat_fitrah + $pen->zakat_mal + $pen->zakat_fidyah, 2))</td>
                <td>{{ round($pen->zakat_beras, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>