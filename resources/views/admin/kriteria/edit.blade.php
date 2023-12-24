@extends('admin.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Edit Kriteria</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Formulir Edit Kriteria</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.kriteria.update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$kriteria->id_kriteria}}">
                            <div class="mb-3">
                                <label class="form-label">ID Kriteria</label>
                                <input class="form-control" type="text" name="id_kriteria" id="id_kriteria" placeholder="Silahkan isi ID Kriteria" required value="{{$kriteria->id_kriteria}}" />
                                @if($errors->has('id_kriteria'))
                                    <span style="color: red;">
                                        <strong>{{$errors->first('id_kriteria')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Kriteria</label>
                                <input class="form-control" type="text" name="nama_kriteria" id="nama_kriteria" placeholder="Silahkan isi jumlah Nama Kriteria" required value="{{$kriteria->nama_kriteria}}"/>
                                @if($errors->has('nama_kriteria'))
                                    <span style="color: red;">
                                        <strong>{{$errors->first('nama_kriteria')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status Kriteria</label>
                                <select class="form-control" name="status_kriteria" id="status_kriteria" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Diketahui" <?= $kriteria->status_kriteria == 'Diketahui' ? 'selected' : '' ?>>Diketahui</option>
                                    <option value="Dicari" <?= $kriteria->status_kriteria == 'Dicari' ? 'selected' : '' ?>>Dicari</option>
                                </select>
                                @if($errors->has('status_kriteria'))
                                    <span style="color: red;">
                                        <strong>{{$errors->first('status_kriteria')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Nilai</label>
                                <select class="form-control" name="nilai" id="nilai" required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="1" <?= $kriteria->nilai == '1' ? 'selected' : '' ?>>Kategorikal</option>
                                    <option value="0" <?= $kriteria->nilai == '0' ? 'selected' : '' ?>>Numerik</option>
                                </select>
                                @if($errors->has('nilai'))
                                    <span style="color: red;">
                                        <strong>{{$errors->first('nilai')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <input class="form-control" value="{{$kriteria->keterangan}}" type="text" name="keterangan" id="keterangan" placeholder="Silahkan isi Keterangan" />
                                @if($errors->has('keterangan'))
                                    <span style="color: red;">
                                        <strong>{{$errors->first('keterangan')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
