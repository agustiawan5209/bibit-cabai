@extends('admin.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3 row">
        	<div class="col-md-6">
            	<h1 class="h3 d-inline align-middle">Data Kriteria</h1>
            </div>
            <div class="col-md-6" style="text-align: right;">
            	<a href="{{route('admin.kriteria.tambah')}}" class="btn btn-success">Tambah</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Kriteria</h5>
                    </div>
                    <div class="card-body">
                    	@if(session('status'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							<div class="alert-message">
								{{session('status')}}
							</div>
						</div>
						@endif
                        <table id="datatables-reponsive" class="table table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID Kriteria</th>
	                                <th>Nama Kriteria</th>
	                                <th>Status Kriteria</th>
                                    <th>Jenis Nilai</th>
                                    <th>keterangan</th>
	                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                			 	@foreach($kriteria as $item)
								<tr>
									<td>{{$item->id_kriteria}}</td>
									<td>{{$item->nama_kriteria}}</td>
                    				<td>{{$item->status_kriteria}}</td>
                    				<td>{{$item->nilai == '1' ? 'Kategorikal' : 'Numerik'}}</td>
                                    <td>{{$item->keterangan}}</td>
									<td>
										<a href="{{route('admin.kriteria.edit', $item->id_kriteria)}}" class="btn btn-sm btn-info">Edit</a>
										<a href="{{route('admin.kriteria.hapus', $item->id_kriteria)}}" class="btn btn-sm btn-danger">Hapus</a>
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
