@extends('admin.layout.app') @section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3 row">
                <div class="col-md-6">
                    <h1 class="h3 d-inline align-middle">Data Latih</h1>
                </div>
                <div class="col-md-6" style="text-align: right;">
                    <a href="{{ route('admin.latih.tambah') }}" class="btn btn-success">Tambah</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Data Latih</h5>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <div class="alert-message">
                                        {{ session('status') }}
                                    </div>
                                </div>
                            @endif
                            <table id="datatables-reponsive" class="table table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        @foreach ($kriteria as $items)
                                            <th><?= $items->nama_kriteria ?></th>
                                        @endforeach
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach ($latih as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            @foreach ($kriteria as $items)
                                                <?php $latih = DB::table('datalatih')
                                                    ->where('nomor', $item->nomor)
                                                    ->where('id_kriteria', $items->id_kriteria)
                                                    ->first(); ?>
                                                @if ($items->nilai == '0')
                                                    <th><?= $latih->id_nilai ?></th>
                                                @else
                                                    <?php $nilai = DB::table('nilai')
                                                        ->where('id_nilai', $latih->id_nilai)
                                                        ->first(); ?>
                                                    <th><?= @$nilai->nama_nilai ?></th>
                                                @endif
                                            @endforeach
                                            <td>
                                                <a href="{{ route('admin.latih.edit', $item->id_datalatih) }}"
                                                    class="btn btn-sm btn-info">Edit</a>
                                                <a href="{{ route('admin.latih.hapus', $item->id_datalatih) }}"
                                                    class="btn btn-sm btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
