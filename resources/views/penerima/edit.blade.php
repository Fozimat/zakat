@extends('template.index')

@section('content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">e-Zakat</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Data Penerima</a>
                <span class="breadcrumb-item active">Edit Data</span>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4>Edit Data Penerima</h4>
            <div class="m-t-25">
                <form action="{{ route('penerima.update', $penerima->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <div class="m-b-15">
                                <select class="select2" required class="form-control" name="muzakki_id" id="muzakki_id">
                                    <option value="">--Pilih--</option>
                                    @foreach ($golongan as $gol)
                                    <option value="{{ $gol->id }}" {{ $gol->id == $penerima->golongan_id ? 'selected' :
                                        '' }}>{{ $gol->kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                value="{{ $penerima->nama }}">
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