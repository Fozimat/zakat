@extends('template.index')

@push('script')
<script>
    $(document).ready(function() {
        $('#valuemal').hide();
        $('#hitung').on('click', function() {
            var emas = $('#emas').val(); 
            var uang = $('#uang').val(); 
            var kendaraan = $('#kendaraan').val(); 
            var hutang = $('#hutang').val();
            var total_mal = parseInt(emas)+parseInt(uang)+parseInt(kendaraan);
            var total = Math.ceil(((parseInt(emas)+parseInt(uang)+parseInt(kendaraan)) - parseInt(hutang))*(0.025));
            
           
            if(total_mal < 81945667){
                total = "Harta Anda Belum memenuhi Nisab";
            } else {
            if(isNaN(total)){
                total = 0;
            } else {
                total = 'Rp '+formatNumber(total);
                }
            }
            $('#valuemal').show();

            $('#jumlahmallabel').empty();
            $('#emaslabel').empty();
            $('#uanglabel').empty();
            $('#kendaraanlabel').empty();
            $('#hutanglabel').empty();

            $('#jumlahmallabel').append(total);
            $('#emaslabel').append('Rp '+formatNumber(emas));
            $('#uanglabel').append('Rp '+formatNumber(uang));
            $('#kendaraanlabel').append('Rp '+formatNumber(kendaraan));
            $('#hutanglabel').append('Rp '+formatNumber(hutang));
        });

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        }
    });
    
</script>
@endpush

@section('content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">e-Zakat</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Zakat Mal</a>
                <span class="breadcrumb-item active">Perhitungan </span>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4>Perhitungan Zakat Mal</h4>
            <div class="m-t-25">
                <form>
                    <div class="form-group row">
                        <label for="emas" class="col-sm-12 col-form-label">Nilai emas,perak,dan/atau pertama</label>
                        <div class="col-sm-12">
                            <input value="0" type="number" class="form-control" id="emas" name="emas"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="uang" class="col-sm-12 col-form-label">Uang tunai, tabungan, deposito</label>
                        <div class="col-sm-12">
                            <input value="0" type="number" class="form-control" id="uang" name="uang"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kendaraan" class="col-sm-12 col-form-label">Kendaraan, rumah, aset lain</label>
                        <div class="col-sm-12">
                            <input value="0" type="number" class="form-control" id="kendaraan" name="kendaraan"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hutang" class="col-sm-12 col-form-label">Jumlah hutang/cicilan (optional)</label>
                        <div class="col-sm-12">
                            <input value="0" type="number" class="form-control" id="hutang" name="hutang"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="button" id="hitung" class="btn btn-success">Hitung</button>
                        </div>
                    </div>
                </form>
                <div id="valuemal">
                    <p class="text-center">Jumlah zakat mal anda:</p>
                    <h1 class="text-center"><span id="jumlahmallabel"></span>,-</h1>
                    <div class="row d-flex">
                        <div class="col-sm-6">
                            <p>Emas, perak, permata:</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p><span id="emaslabel"></span>,-</p>
                        </div>
                        <div class="col-sm-6">
                            <p>Tabungan dan lainnya:</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p><span id="uanglabel"></span>,-</p>
                        </div>
                        <div class="col-sm-6">
                            <p>Kendaraan dan aset lain:</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p><span id="kendaraanlabel"></span>,-</p>
                        </div>
                        <div class="col-sm-6">
                            <p>Hutang dan cicilan:</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p><span id="hutanglabel"></span>,-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection