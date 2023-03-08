<!DOCTYPE html>
<html>

<head>
    <title>{{ $zakat->no_transaksi }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        tr td {
            padding: 4px !important;
            margin: 0 !important;
        }

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
                <td>
                    <p class="fs-12">No: {{ $zakat->no_transaksi }}</p>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="text-center">
        <h5 class="mt_40"><u>TANDA PENERIMAAN</u></h5>
    </div>

    <table class="table">
        <tbody>
            <tr>
                <td class="td-20">
                    <p class="fs-15">NAMA</p>
                </td>
                <td class="td-1">
                    <p class="fs-15">:</p>
                </td>
                <td>
                    <p class="fs-15">{{ $zakat->muzakki->nama }}</p>
                </td>
            </tr>
            <tr>
                <td class="td-20">
                    <p class="fs-15">ALAMAT</p>
                </td>
                <td class="td-1">
                    <p class="fs-15">:</p>
                </td>
                <td>
                    <p class="fs-15">{{ $zakat->muzakki->alamat }}</p>
                </td>
            </tr>
            <tr>
                <td class="td-20">
                    <p class="fs-15">JUMLAH JIWA</p>
                </td>
                <td class="td-1">
                    <p class="fs-15">:</p>
                </td>
                <td>
                    <p class="fs-15">{{ $zakat->jumlah_jiwa }} Orang ( @ Rp. @format_angka($zakat->zakat_fitrah_uang) )
                    </p>
                </td>
            </tr>
            <tr>
                <td class="td-20">
                    <p class="fs-15">JENIS ZAKAT</p>
                </td>
                <td class="td-1">
                    <p class="fs-15">:</p>
                </td>
                <td>
                    <p class="fs-15">1a. ZAKAT FITRAH (Uang) : Rp. @format_angka($zakat->total_zakat_fitrah_uang)</p>
                    <p class="fs-15"> 1b. ZAKAT FITRAH (Beras) : @format_angka($zakat->zakat_fitrah_beras) Kg</p>
                    <p class="fs-15">2. ZAKAT MAL : Rp. @format_angka($zakat->zakat_mal)</p>
                    <p class="fs-15">3. FIDYAH : Rp. @format_angka($zakat->zakat_fidyah)</p>
                </td>
            </tr>
            <tr>
                <td class="td-20">
                    <p class="fs-15">INFAQ</p>
                </td>
                <td class="td-1">
                    <p class="fs-15">:</p>
                </td>
                <td>
                    <p class="fs-15">Rp. @format_angka($zakat->infaq)</p>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="fs-15">
        @if ($zakat->anggota_keluarga()->exists())
        <tr>
            <td>Daftar Keluarga:</td>
        </tr>
        @foreach ($zakat->anggota_keluarga as $key => $nama)
        <tr>
            <td>{{ $key + 1 }}. {{ $nama->nama }}</td>
        </tr>
        @endforeach
        @endif
    </table>
    <table style="margin-left: 750px;margin-top: -200px;text-align: center;">
        <tr>
            <td class="fs-14 text-right">Tanjungpinang, {{ \Carbon\Carbon::now()->isoFormat('DD MMMM Y') }}</td>
        </tr>
        <tr>
            <td style="margin-left: 730px;" class="fs-14">Panitia,</td>
        </tr>
        <tr>
            <td style="height: 45px;"></td>
        </tr>
        <tr>
            <td class="fs-14">_______________________</td>
        </tr>
        <tr>
            <td class="fs-14">({{ $zakat->amil->nama }})</td>
        </tr>
    </table>
</body>

</html>