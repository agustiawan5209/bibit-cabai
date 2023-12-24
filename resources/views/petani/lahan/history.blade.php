@extends('petani.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3 row">
        	<div class="col-md-6">
            	<h1 class="h3 d-inline align-middle">Data History Pengujian Cabai</h1>
            </div>
            <div class="col-md-6" style="text-align: right;">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Pengujian Cabai</h5>
                    </div>
                    <div class="card-body">
                        <table id="datatables-reponsive" class="table table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Cabai</th>
                                    <th>Alamat</th>
                                    <th>Waktu</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                			 	@foreach($history as $item)
								<tr>
									<td>{{$no++}}</td>
                                    <td>{{$item->nama_lahan}}</td>
                                    <td>{{$item->alamat}}</td>
                                    <td>{{UserHelp::tanggal_indo($item->waktu, true)}}</td>
                                    <td>{{$item->hasil}}</td>
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
