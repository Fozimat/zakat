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
                <span class="breadcrumb-item active">Data Penerima</span>
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


    @if (session('alert_fail'))
    <div class="alert alert-danger alert-dismissible fade show">
        <div class="d-flex align-items-center justify-content-start">
            <span class="alert-icon">
                <i class="anticon anticon-check-o"></i>
            </span>
            <span>{{ session('alert_fail') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    @if(Auth::user()->level == 'ADMIN')
    <a href="{{ route('penerima.create') }}" class="btn btn-secondary mb-4">Tambah Data</a>
    <a href="{{ route('penerima.distribusi') }}" class="btn btn-success mb-4">Distribusi Zakat</a>
    @endif
    @foreach ($golongan as $gol)
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>{{ $gol->kategori }}</h4>

            </div>
            <div class="m-t-25">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Golongan</th>
                                @if(Auth::user()->level == 'ADMIN')
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gol->penerima->where('golongan_id', $gol->id)->where('terima', 0) as $muz)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $muz->nama }}</td>
                                <td>{{ $muz->golongan->kategori }}</td>
                                @if(Auth::user()->level == 'ADMIN')
                                <td>
                                    <a href="{{ route('penerima.edit', $muz->id) }}">
                                        <button class="btn btn-icon btn-warning btn-rounded">
                                            <i class="anticon anticon-edit"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route('penerima.destroy', $muz->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Apakah anda yakin?')" type="submit"
                                            class="btn btn-icon btn-danger btn-rounded">
                                            <i class="anticon anticon-delete"></i>
                                        </button>
                                        <form>
                                </td>
                                @endif
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
                                        <form action="{{ route('penerima.destroy', $muz->id) }}" method="POST">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection