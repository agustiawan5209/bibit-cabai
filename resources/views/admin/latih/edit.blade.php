@extends('admin.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Edit Data Latih</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Formulir Edit Data Latih</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.latih.update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$latih->id_datalatih}}">
                        <input type="hidden" name="nomor" value="{{$latih->nomor}}">
                            <div class="mb-3">
                                <label class="form-label">Nomor</label>
                                <input class="form-control" type="number" name="nomornya" id="nomornya" placeholder="Silahkan isi nomor" required disabled value="{{$latih->nomor}}" />
                                @if($errors->has('nomor'))
                                    <span style="color: red;">
                                        <strong>{{$errors->first('nomor')}}</strong>
                                    </span>
                                @endif
                            </div>
                            @foreach($kriteria as $item)
                                <?php  $latih_awal = DB::table('datalatih')->where('nomor', $latih->nomor)->where('id_kriteria', $item->id_kriteria)->first(); ?>
                                @if($item->nilai == '0')
                                    <div class="mb-3">
                                        <label class="form-label">{{$item->nama_kriteria}}</label>
                                        <input class="form-control" type="number" name="{{$item->id_kriteria}}" id="{{$item->id_kriteria}}" placeholder="Silahkan isi {{$item->nama_kriteria}}" value="{{$latih_awal->id_nilai}}" required />
                                        <small>{{$item->keterangan}}</small>
                                    </div>
                                @else
                                <?php  $nilai_awal = DB::table('nilai')->where('id_nilai', @$latih_awal->id_nilai)->first(); ?>
                                    <div class="mb-3">
                                        <label class="form-label">{{$item->nama_kriteria}}</label>
                                        <select class="form-control" name="{{$item->id_kriteria}}" id="{{$item->id_kriteria}}" required>
                                            <option value="">Pilih {{$item->nama_kriteria}}</option>
                                            <?php 
                                            $nilai = DB::table('nilai')->where('id_kriteria', $item->id_kriteria)->get();
                                            ?>
                                            @foreach($nilai as $items)
                                            <option value="<?= @$items->id_nilai ?>" <?= @$nilai_awal->id_nilai == @$items->id_nilai ? 'selected' : '' ?>><?= $items->nama_nilai ?></option>
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
