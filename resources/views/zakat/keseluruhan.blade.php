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
    </style>
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