<!DOCTYPE html>
<html>

<head>
    <title>Laporan Panitia Amil Zakat Al-Maghfiroh dari {{ \Carbon\Carbon::parse($dari_tanggal)->isoFormat('
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
                <td class="td-75">
                    <h5 class="fs-15">PANITIA / AMIL ZAKAT</h5>
                    <h5 class="mt-10 fs-15">MASJID AL-MAGHFIROH</h5>
                    <p class="mt-10 fs-12"><u>Jl. Kp. Wonosari RT 2 / IV TPI</u></p>
                </td>
            </tr>
        </tbody>
    </table>

    <center>
        <h5>Laporan Panitia Amil Zakat Al-Maghfiroh dari {{ \Carbon\Carbon::parse($dari_tanggal)->isoFormat('
            DD MMMM Y') }} sampai {{ \Carbon\Carbon::parse($sampai_tanggal)->isoFormat('
            DD MMMM Y') }} </h5>
    </center>

    <table class='table table-bordered mb-2'>
        <thead>
            <tr>
                <th>No</th>
                <th>No Transaksi</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Jumlah Jiwa</th>
                <th>Uang</th>
                <th>Total Beras</th>
                <th>Total Uang</th>
                <th>Mal</th>
                <th>Fidyah</th>
                <th>Infaq</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total_zakat_fitrah = $total_zakat_beras = $total_mal = $total_fidyah = $total_infaq = 0;
            $total_keseluruhan_zakat_fitrah_beras = $total_keseluruhan_zakat_fitrah_uang = $total_keseluruhan_zakat_mal
            =
            $total_keseluruhan_zakat_fidyah = $total_keseluruhan_infaq = 0;
            @endphp
            @foreach ($zakat as $key => $data)
            @php
            $total_zakat_fitrah += $data->total_zakat_fitrah_uang;
            $total_zakat_beras += $data->zakat_fitrah_beras;
            $total_mal += $data->zakat_mal;
            $total_fidyah += $data->zakat_fidyah;
            $total_infaq += $data->infaq;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->no_transaksi }}</td>
                <td>{{ $data->tanggal_transaksi->isoFormat('D MMMM Y') }}</td>
                <td>{{ $data->muzakki->nama }}</td>
                <td>{{ $data->jumlah_jiwa }} Orang</td>
                <td>@format_angka($data->zakat_fitrah_uang)</td>
                <td>@format_angka($data->zakat_fitrah_beras) Kg</td>
                <td>@format_angka($data->total_zakat_fitrah_uang)</td>
                <td>@format_angka($data->zakat_mal)</td>
                <td>@format_angka($data->zakat_fidyah)</td>
                <td>@format_angka($data->infaq)</td>
            </tr>
            @if (@$zakat[$key+1]['tanggal_transaksi'] != $data['tanggal_transaksi'])
            <tr>
                <td colspan="6" class="text-center"><strong>Total</strong></td>
                <td><strong>@format_angka($total_zakat_beras) Kg</strong></td>
                <td><strong>@format_angka($total_zakat_fitrah)</strong></td>
                <td><strong>@format_angka($total_mal)</strong></td>
                <td><strong>@format_angka($total_fidyah)</strong></td>
                <td><strong>@format_angka($total_infaq)</strong></td>
            </tr>
            @php
            $total_zakat_fitrah = $total_zakat_beras = $total_mal = $total_fidyah = $total_infaq = 0;
            @endphp
            @endif
            @php
            $total_keseluruhan_zakat_fitrah_beras += $data->zakat_fitrah_beras;
            $total_keseluruhan_zakat_fitrah_uang += $data->total_zakat_fitrah_uang;
            $total_keseluruhan_zakat_mal += $data->zakat_mal;
            $total_keseluruhan_zakat_fidyah += $data->zakat_fidyah;
            $total_keseluruhan_infaq += $data->infaq;
            @endphp
            @endforeach
            <tr>
                <td colspan="6" class="text-center"><strong>Total Keseluruhan</strong></td>
                <td><strong>@format_angka($total_keseluruhan_zakat_fitrah_beras) Kg</strong></td>
                <td><strong>@format_angka($total_keseluruhan_zakat_fitrah_uang)</strong></td>
                <td><strong>@format_angka($total_keseluruhan_zakat_mal)</strong></td>
                <td><strong>@format_angka($total_keseluruhan_zakat_fidyah)</strong></td>
                <td><strong>@format_angka($total_keseluruhan_infaq)</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>