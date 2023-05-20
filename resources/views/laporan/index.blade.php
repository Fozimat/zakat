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
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Laporan</a>
                <span class="breadcrumb-item active">Cetak Laporan</span>
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
            <h4>Cetak Laporan Pembayaran Zakat</h4>
            <div class="m-t-25">
                <form action="{{ route('laporan.keseluruhan') }}" method="POST" target="_blank">
                    @csrf
                    <div class="form-group row">
                        <label for="dari_tanggal" class="col-sm-2 col-form-label">Dari Tanggal</label>
                        <div class="col-sm-10">
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input required type="text" class="form-control datepicker-input" id="dari_tanggal"
                                    name="dari_tanggal" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sampai_tanggal" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                        <div class="col-sm-10">
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input required type="text" class="form-control datepicker-input" id="sampai_tanggal"
                                    name="sampai_tanggal" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sampai_tanggal" class="col-sm-2 col-form-label">Filter</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="check_fitrah"
                                    id="check_fitrah">
                                <label class="form-check-label" for="check_fitrah">
                                    Zakat Fitrah (uang)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="check_beras"
                                    id="check_beras">
                                <label class="form-check-label" for="check_beras">
                                    Zakat Fitrah (beras)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="check_mal"
                                    id="check_mal">
                                <label class="form-check-label" for="check_mal">
                                    Zakat Mal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="check_fidyah"
                                    id="check_fidyah">
                                <label class="form-check-label" for="check_fidyah">
                                    Zakat Fidyah
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="check_infaq"
                                    id="check_infaq">
                                <label class="form-check-label" for="check_infaq">
                                    Infaq
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Cetak</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4>Cetak Laporan Distribusi Zakat</h4>
            <div class="m-t-25">
                <form action="{{ route('laporan.distribusi') }}" method="POST" target="_blank">
                    @csrf
                    <div class="form-group row">
                        <label for="dari_tanggal" class="col-sm-2 col-form-label">Dari Tanggal</label>
                        <div class="col-sm-10">
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input required type="text" class="form-control datepicker-input" id="dari_tanggal"
                                    name="dari_tanggal" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sampai_tanggal" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                        <div class="col-sm-10">
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input required type="text" class="form-control datepicker-input" id="sampai_tanggal"
                                    name="sampai_tanggal" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection