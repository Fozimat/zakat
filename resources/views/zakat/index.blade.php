@extends('template.index')

@push('style')
<link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@push('script')
<script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
@endpush

@section('content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">e-Zakat</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Pembayaran Zakat</a>
                <span class="breadcrumb-item active">Data Zakat</span>
            </nav>
        </div>
    </div>
    @if (session('alert'))
    <div class="alert alert-success alert-dismissible fade show">
        <div class="d-flex align-items-center justify-content-start">
            <span class="alert-icon">
                <i class="anticon anticon-check-o"></i>
            </span>
            <span>{{ session('alert') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>PEMBAYARAN ZAKAT</h4>
                <a href="{{ route('zakat.create') }}" class="btn btn-secondary">Tambah Data</a>
            </div>
            <div class="m-t-25">
                <div class="table-responsive">
                    <table id="data-table" class="table">
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
                                <th>Fidyah</th>
                                <th>Infaq</th>
                                <th>Amil Zakat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($zakat as $z)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $z->no_transaksi }}</td>
                                <td>{{ $z->tanggal_transaksi->isoFormat('D MMMM Y') }}</td>
                                <td>{{ $z->muzakki->nama }}</td>
                                <td>{{ $z->jumlah_jiwa }}</td>
                                <td>@format_angka($z->total_zakat_fitrah_uang)</td>
                                <td>@format_angka($z->zakat_fitrah_beras)</td>
                                <td>@format_angka($z->zakat_mal)</td>
                                <td>@format_angka($z->zakat_fidyah)</td>
                                <td>@format_angka($z->infaq)</td>
                                <td>{{ $z->amil->nama }}</td>
                                <td>
                                    <a target="_blank" href="{{ route('zakat.invoice', $z->id) }}">
                                        <button class="btn btn-icon btn-success btn-rounded">
                                            <i class="anticon anticon-printer"></i> </button>
                                    </a>
                                    <a href="{{ route('zakat.edit', $z->id) }}">
                                        <button class="btn btn-icon btn-warning btn-rounded">
                                            <i class="anticon anticon-edit"></i>
                                        </button>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#hapusZakat"
                                        class="btn btn-icon btn-danger btn-rounded">
                                        <i class="anticon anticon-delete"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="hapusZakat">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data?</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <i class="anticon anticon-close"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('zakat.destroy', $z->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                Apakah anda yakin?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <i class="anticon anticon-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                        <tfoot>
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
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection