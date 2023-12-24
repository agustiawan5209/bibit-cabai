@extends('petani.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Tambah Data Cabai</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Formulir Tambah Data Cabai</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('petani.lahan.uji')}}" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Cabai</label>
                                <input class="form-control" type="text" name="nama_lahan" id="nama_lahan" placeholder="Silahkan isi nama lahan" required/>
                                @if($errors->has('nama_lahan'))
                                    <span style="color: red;">
                                        <strong>{{$errors->first('nama_lahan')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat / Lokasi</label>
                                <input class="form-control" type="text" name="alamat" id="alamat" placeholder="Silahkan isi nama alamat / lokasi" required/>
                                @if($errors->has('alamat'))
                                    <span style="color: red;">
                                        <strong>{{$errors->first('alamat')}}</strong>
                                    </span>
                                @endif
                            </div>
                            @foreach($kriteria as $item)
                                @if($item->nilai == '0')
                                    <div class="mb-3">
                                        <label class="form-label">{{$item->nama_kriteria}}</label>
                                        <input class="form-control" type="number" name="{{$item->id_kriteria}}" id="{{$item->id_kriteria}}" placeholder="Silahkan isi {{$item->nama_kriteria}}" required />
                                        <small>{{$item->keterangan}}</small>
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <label class="form-label">{{$item->nama_kriteria}}</label>
                                        <select class="form-control" name="{{$item->id_kriteria}}" id="{{$item->id_kriteria}}" required>
                                            <option value="">Pilih {{$item->nama_kriteria}}</option>
                                            <?php
                                            $nilai = DB::table('nilai')->where('id_kriteria', $item->id_kriteria)->get();
                                            ?>
                                            @foreach($nilai as $items)
                                            <option value="<?= $items->id_nilai ?>" ><?= $items->nama_nilai ?></option>
                                            @endforeach
                                        </select>
                                        <small>{{$item->keterangan}}</small>
                                    </div>
                                @endif
                            @endforeach
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
