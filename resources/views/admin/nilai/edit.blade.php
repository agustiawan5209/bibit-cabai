@extends('admin.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Edit Nilai Kriteria</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Formulir Edit Nilai Kriteria</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.nilai.update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$nilai->id_nilai}}">
                            <div class="mb-3">
                                <label class="form-label">Kriteria</label>
                                <select class="form-control" name="id_kriteria" id="id_kriteria" required>
                                    <option value="">Pilih Kriteria</option>
                                    @foreach($kriteria as $item)
                                    <option value="<?= $item->id_kriteria ?>" <?= $nilai->id_kriteria == $item->id_kriteria ? 'selected' : '' ?>>[<?= $item->id_kriteria ?>] <?= $item->nama_kriteria ?></option>
                                    @endforeach
                                </select>
                                @if($errors->has('id_kriteria'))
                                    <span style="color: red;">
                                        <strong>{{$errors->first('id_kriteria')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Nilai</label>
                                <input class="form-control" value="{{$nilai->nama_nilai}}" type="text" name="nama_nilai" id="nama_nilai" placeholder="Silahkan isi nama nilai" />
                                @if($errors->has('nama_nilai'))
                                    <span style="color: red;">
                                        <strong>{{$errors->first('nama_nilai')}}</strong>
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
