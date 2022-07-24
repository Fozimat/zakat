<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No Transaksi</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Jumlah Jiwa</th>
            <th>Fitrah(Uang)</th>
            <th>Fitrah(Beras)</th>
            <th>Zakat Mal</th>
            <th>Zakat Fidyah</th>
            <th>Infaq</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($zakat as $z)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $z->no_transaksi }}</td>
            <td>{{ $z->tanggal_transaksi->isoFormat('D MMMM Y') }}</td>
            <td>{{ $z->nama }}</td>
            <td>{{ $z->jumlah_jiwa }}</td>
            <td>{{$z->total_zakat_fitrah_uang }}</td>
            <td>{{$z->zakat_fitrah_beras }}</td>
            <td>{{$z->zakat_mal }}</td>
            <td>{{$z->zakat_fidyah }}</td>
            <td>{{$z->infaq }}</td>
        </tr>
        @endforeach
    </tbody>
</table>