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
<script>
    $(document).ready(function () {                            
    $("#radio1, #radio2").change(function () {
        if ($("#radio1").is(":checked")) {
            $('#show_fitrah_uang').removeClass('d-none');
            $('#show_fitrah_beras').addClass('d-none');
        }
        else {
            $('#show_fitrah_beras').removeClass('d-none');
            $('#show_fitrah_uang').addClass('d-none');
        }
    });
    $('#zakat_fitrah_uang, #jumlah_jiwa').keyup(function() {
        let jumlah_jiwa = $('#jumlah_jiwa').val();
        let zakat_fitrah_uang = $('#zakat_fitrah_uang').val();
        let total_zakat_fitrah_uang = parseInt(jumlah_jiwa) * 2.5 * parseInt(zakat_fitrah_uang);
        $('#total_zakat_fitrah_uang').val(total_zakat_fitrah_uang);
    });        
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
                <span class="breadcrumb-item active">Edit Data</span>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4>Edit Data Zakat</h4>
            <div class="m-t-25">
                <form action="{{ route('zakat.update', $zakat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="no_transaksi" class="col-sm-2 col-form-label">Nomor Transaksi</label>
                        <div class="col-sm-10">
                            <input readonly type="text" class="form-control" id="no_transaksi" name="no_transaksi"
                                value="{{ $zakat->no_transaksi }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_transaksi" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input required type="text" class="form-control datepicker-input" id="tanggal_transaksi"
                                    name="tanggal_transaksi" autocomplete="off"
                                    value="{{ $zakat->tanggal_transaksi->format('m/d/Y') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                value="{{ $zakat->nama }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea required class="form-control" name="alamat" id="alamat" rows="3"
                                autocomplete="off">{{ $zakat->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_jiwa" class="col-sm-2 col-form-label">Jumlah Jiwa</label>
                        <div class="col-sm-10">
                            <input required type="number" class="form-control" id="jumlah_jiwa" name="jumlah_jiwa"
                                autocomplete="off" value="{{ $zakat->jumlah_jiwa }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <div class="radio">
                                <input id="radio1" name="pilih_zakat_fitrah" type="radio" {{ $zakat->zakat_fitrah_beras
                                == 0 ? 'checked' : '' }}>
                                <label for="radio1">Zakat Fitrah (Uang)</label>
                            </div>
                            <div class="radio">
                                <input id="radio2" name="pilih_zakat_fitrah" type="radio" {{ $zakat->zakat_fitrah_beras
                                == 0 ? '' : 'checked' }}>
                                <label for="radio2">Zakat Fitrah (Beras)</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row {{ $zakat->zakat_fitrah_beras
                        == 0 ? '' : 'd-none' }}" id="show_fitrah_uang">
                        <label for="zakat_fitrah_uang" class="col-sm-2 col-form-label">Zakat Fitrah (Uang)</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="zakat_fitrah_uang" name="zakat_fitrah_uang"
                                autocomplete="off" value="{{ $zakat->zakat_fitrah_uang }}" placeholder="Harga Beras">
                        </div>
                        <div class="col-sm-5">
                            <input readonly type="number" class="form-control" id="total_zakat_fitrah_uang"
                                name="total_zakat_fitrah_uang" placeholder="Total Uang"
                                value="{{ $zakat->total_zakat_fitrah_uang }}">
                        </div>
                    </div>
                    <div class="form-group row {{ $zakat->zakat_fitrah_beras
                        == 0 ? 'd-none' : '' }}" id="show_fitrah_beras">
                        <label for="zakat_fitrah_beras" class="col-sm-2 col-form-label">Zakat Fitrah (Beras)</label>
                        <div class="col-sm-10">
                            <input type="number" value="{{ $zakat->zakat_fitrah_beras }}" class="form-control"
                                id="zakat_fitrah_beras" name="zakat_fitrah_beras" autocomplete="off" placeholder="Kg">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zakat_mal" class="col-sm-2 col-form-label">Zakat Mal</label>
                        <div class="col-sm-10">
                            <input required type="number" value="{{ $zakat->zakat_mal }}" class="form-control"
                                id="zakat_mal" name="zakat_mal" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zakat_fidyah" class="col-sm-2 col-form-label">Zakat Fidyah</label>
                        <div class="col-sm-10">
                            <input required type="number" class="form-control" id="zakat_fidyah" name="zakat_fidyah"
                                autocomplete="off" value="{{ $zakat->zakat_fidyah }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="infaq" class="col-sm-2 col-form-label">Infaq</label>
                        <div class="col-sm-10">
                            <input required type="number" class="form-control" id="infaq" name="infaq"
                                value="{{ $zakat->infaq }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection