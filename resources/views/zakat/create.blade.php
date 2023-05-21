@extends('template.index')

@push('style')
<link href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/select2/select2.css') }}" rel="stylesheet">
@endpush

@push('script')
<script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>

<script>
    $('.select2').select2();
    $('.datepicker-input').datepicker({
        format: 'mm/dd/yyyy',
        locale: 'en'
    });
</script>
<script>
    $(document).ready(function () {   

        $('#jumlah_jiwa').keyup(function() {
            let jumlah_jiwa = this.value;
            $('#jumlahDinamis').text('');
            for(let i = 1; i < jumlah_jiwa; i++) {
                $('#jumlahDinamis').append(`
                    <div class="form-group row">
                            <label for="anggota_keluarga" class="col-sm-2 col-form-label">Ke-${i}</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="anggota_keluarga${i}" name="anggota_keluarga[]"
                                    autocomplete="off">
                            </div>
                    </div>
                `);
            }
        });

        function hitungFitrahBeras() {
            let jumlah_jiwa = $('#jumlah_jiwa').val();
            let total_fitrah_beras = parseFloat(jumlah_jiwa) * 2.5;
            $('#zakat_fitrah_beras').val(total_fitrah_beras);
        }

        $("#radio1, #radio2").change(function () {
            if ($("#radio1").is(":checked")) {
                $('#show_fitrah_uang').removeClass('d-none');
                $('#show_fitrah_beras').addClass('d-none');
            }
            else {
                $('#show_fitrah_beras').removeClass('d-none');
                $('#show_fitrah_uang').addClass('d-none');
                hitungFitrahBeras();
            }
        });

        $('#zakat_fitrah_uang, #jumlah_jiwa, #zakat_mal, #hari_fidyah, #infaq').keyup(function() {
            let jumlah_jiwa = $('#jumlah_jiwa').val();
            let zakat_fitrah_uang = $('#zakat_fitrah_uang').val();
            let total_zakat_fitrah_uang = parseInt(jumlah_jiwa) * 2.5 * parseInt(zakat_fitrah_uang);

            let zakat_mal = $('#zakat_mal').val();
            let hari_fidyah = $('#hari_fidyah').val();
            let infaq = $('#infaq').val();

            let total_fidyah = 50000 * hari_fidyah;

            let total_keseluruhan = total_zakat_fitrah_uang + parseFloat(zakat_mal) + parseFloat(total_fidyah) + parseFloat(infaq);
            hitungFitrahBeras();
            $('#total_keseluruhan').val(total_keseluruhan);

            $('#total_zakat_fitrah_uang').val(total_zakat_fitrah_uang);
            $('#zakat_fidyah').val(total_fidyah);
        });        

        $('#bayar').keyup(function() {
        let total_keseluruhan = $('#total_keseluruhan').val();
        let bayar = $('#bayar').val();
        let kembalian = parseFloat(bayar) - parseFloat(total_keseluruhan);
            $('#kembali').val(kembalian);
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
                        <label for="no_transaksi" class="col-sm-2 col-form-label">Nomor Transaksi</label>
                        <div class="col-sm-10">
                            <input readonly type="text" value="{{ $generate_no_transaksi }}" class="form-control"
                                id="no_transaksi" name="no_transaksi" autocomplete="off">

                            <input readonly type="hidden" value="{{ Auth::user()->id }}" class="form-control"
                                id="user_id" name="user_id" autocomplete="off">
                        </div>
                    </div>
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
                            <div class="m-b-15">
                                <select class="select2" required class="form-control" name="muzakki_id" id="muzakki_id">
                                    <option value="">--Pilih--</option>
                                    @foreach ($muzakki as $muz)
                                    <option value="{{ $muz->id }}">{{ $muz->nama }} - {{ $muz->nik }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_jiwa" class="col-sm-2 col-form-label">Jumlah Jiwa</label>
                        <div class="col-sm-10">
                            <input required type="number" class="form-control" id="jumlah_jiwa" name="jumlah_jiwa"
                                autocomplete="off">
                        </div>
                    </div>
                    <div id="jumlahDinamis">

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <div class="radio">
                                <input id="radio1" name="pilih_zakat_fitrah" type="radio" value="uang">
                                <label for="radio1">Zakat Fitrah (Uang)</label>
                            </div>
                            <div class="radio">
                                <input id="radio2" name="pilih_zakat_fitrah" type="radio" value="beras">
                                <label for="radio2">Zakat Fitrah (Beras)</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-none" id="show_fitrah_uang">
                        <label for="zakat_fitrah_uang" class="col-sm-2 col-form-label">Zakat Fitrah (Uang)</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="zakat_fitrah_uang" name="zakat_fitrah_uang"
                                autocomplete="off" value="0" placeholder="Harga Beras">
                        </div>
                        <div class="col-sm-5">
                            <input readonly type="number" class="form-control" id="total_zakat_fitrah_uang"
                                name="total_zakat_fitrah_uang" placeholder="Total Uang">
                        </div>
                    </div>
                    <div class="form-group row d-none" id="show_fitrah_beras">
                        <label for="zakat_fitrah_beras" class="col-sm-2 col-form-label">Zakat Fitrah (Beras)</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="zakat_fitrah_beras" name="zakat_fitrah_beras"
                                autocomplete="off" placeholder="Kg..." readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zakat_mal" class="col-sm-2 col-form-label">Zakat Mal</label>
                        <div class="col-sm-10">
                            <input value="0" required type="number" class="form-control" id="zakat_mal" name="zakat_mal"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hari_fidyah" class="col-sm-2 col-form-label">Fidyah</label>
                        <div class="col-sm-3">
                            <input type="number" placeholder="Masukkan Hari..." class="form-control" id="hari_fidyah"
                                name="hari_fidyah">
                        </div>
                        <div class="col-sm-7">
                            <input placeholder="Total Fidyah" required type="number" class="form-control"
                                id="zakat_fidyah" name="zakat_fidyah" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="infaq" class="col-sm-2 col-form-label">Infaq</label>
                        <div class="col-sm-10">
                            <input value="0" required type="number" class="form-control" id="infaq" name="infaq"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_keseluruhan" class="col-sm-2 col-form-label">Total Keseluruhan</label>
                        <div class="col-sm-10">
                            <input value="0" readonly type="text" class="form-control" id="total_keseluruhan"
                                name="total_keseluruhan" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bayar" class="col-sm-2 col-form-label">Total Bayar</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bayar" name="bayar" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kembali" class="col-sm-2 col-form-label">Kembali</label>
                        <div class="col-sm-10">
                            <input readonly type="text" class="form-control" id="kembali" name="kembali"
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