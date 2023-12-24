@extends('admin.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3 row">
        	<div class="col-md-12">
            	<h1 class="h3 d-inline align-middle">Data Pengguna</h1>
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
                                    <th>Nama</th>
	                                <th>Username</th>
	                                <th>Password</th>
	                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                			 	@foreach($pengguna as $item)
								<tr>
									<td>{{$item->nama_petani}}</td>
									<td>{{$item->user}}</td>
                    				<td>{{$item->pass}}</td>
									<td>
										<a href="{{route('admin.pengguna.edit', $item->id_user)}}" class="btn btn-sm btn-info">Edit</a>
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
