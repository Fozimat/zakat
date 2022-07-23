@extends('template.index')

@push('style')
<link href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endpush

@push('script')
<script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script>
    $('.datepicker-input').datepicker({
        format: 'mm/dd/yyyy',
        locale: 'en'
    });
</script>
@endpush

@section('content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">e-Zakat</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Pembayaran Zakat</a>
                <span class="breadcrumb-item active">Tambah Data</span>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4>Tambah Data Zakat</h4>
            <div class="m-t-25">
                <form action="{{ route('zakat.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="tanggal_transaksi" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input required type="text" class="form-control datepicker-input" id="tanggal_transaksi"
                                    name="tanggal_transaksi" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea required class="form-control" name="alamat" id="alamat" rows="3"
                                autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_jiwa" class="col-sm-2 col-form-label">Jumlah Jiwa</label>
                        <div class="col-sm-10">
                            <input required type="number" class="form-control" id="jumlah_jiwa" name="jumlah_jiwa"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zakat_fitrah_uang" class="col-sm-2 col-form-label">Zakat Fitrah (Uang)</label>
                        <div class="col-sm-10">
                            <input required type="number" class="form-control" id="zakat_fitrah_uang"
                                name="zakat_fitrah_uang" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zakat_fitrah_beras" class="col-sm-2 col-form-label">Zakat Fitrah (Beras)</label>
                        <div class="col-sm-10">
                            <input required type="number" class="form-control" id="zakat_fitrah_beras"
                                name="zakat_fitrah_beras" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zakat_mal" class="col-sm-2 col-form-label">Zakat Mal</label>
                        <div class="col-sm-10">
                            <input required type="number" class="form-control" id="zakat_mal" name="zakat_mal"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="infaq" class="col-sm-2 col-form-label">Infaq</label>
                        <div class="col-sm-10">
                            <input required type="number" class="form-control" id="infaq" name="infaq"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection