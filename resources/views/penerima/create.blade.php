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
</script>

<script>
    let rowCount = 1;
    $('#add').click(function() {
        rowCount++;
        $('#data-table tbody').append(`
        <tr id="row${rowCount}">
            <td>
                <select class="select2" required class="form-control" name="golongan_id[]"
                    id="golongan_id_${rowCount}">
                    <option value="">--Pilih--</option>
                    @foreach ($golongan as $gol)
                    <option value="{{ $gol->id }}">{{ $gol->kategori }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input required type="text" class="form-control" id="nama_${rowCount}" name="nama[]"
                    autocomplete="off">
            </td>
            <td>
                <button type="button" name="remove" id="${rowCount}" class="btn btn-danger btn_remove cicle">-</button>
            </td>
        </tr>
        `);
        $('.select2').select2();
    });

    $(document).on('click', '.btn_remove', function() {
        let button_id = $(this).attr('id');
        $('#row'+button_id+'').remove();
    });

</script>
@endpush

@section('content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">e-Zakat</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Data Penerima</a>
                <span class="breadcrumb-item active">Tambah Data</span>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <h4>Tambah Penerima</h4>
            <div class="m-t-25">
                <form action="{{ route('penerima.store') }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table id="data-table" class="table">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="select2" required class="form-control" name="golongan_id[]"
                                            id="golongan_id">
                                            <option value="">--Pilih--</option>
                                            @foreach ($golongan as $gol)
                                            <option value="{{ $gol->id }}">{{ $gol->kategori }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input required type="text" class="form-control" id="nama_1" name="nama[]"
                                            autocomplete="off">
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="add"
                                            class="btn btn-success circle">+</button>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
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