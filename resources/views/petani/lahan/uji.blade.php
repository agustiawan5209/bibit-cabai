@extends('petani.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3 row">
        	<div class="col-md-6">
            	<h1 class="h3 d-inline align-middle">Hasil Uji Data Cabai</h1>
            </div>
            <div class="col-md-6" style="text-align: right;">
            </div>
        </div>

        <div class="row">
        	<div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Yang Diketahui</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" style="width: 100%;">
                            <thead>
                            	@foreach($kriteria as $items)
                                <tr>
                                    <td style="width: 20%"><?= $items->nama_kriteria ?></td>
                                    <td>: {{$request[$items->id_kriteria]}}</td>
                                </tr>
                                @endforeach
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Pengujian Jarak</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    @foreach($kriteria as $items)
                                    <th><?= $items->nama_kriteria ?></th>
                                    @endforeach
                                    <th>Jarak</th>
	                                <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
			                        for( $j=0; $j< count( $distances ); $j++ ) {
			                    ?>
			                        <tr>
			                            <td>
			                                <?php echo $distances[$j]['nomor']?>
			                            </td>
			                            @foreach($kriteria as $items)
			                            <td>
			                                <?php echo $distances[$j][$items->id_kriteria] ?>
			                            </td>
			                            @endforeach
			                            <td>
			                                <?php echo $distances[$j]['distance'] ?>
			                            </td>
			                            <td>
			                                <?php echo $distances[$j]['hasil'] ?>
			                            </td>
			                        </tr>
			                    <?php
			                    }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Hasil Pengujian</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Cabai</th>
                                    <th>Alamat</th>
                                    @foreach($kriteria as $items)
                                    <th><?= $items->nama_kriteria ?></th>
                                    @endforeach
	                                <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
			                        <tr>
			                            <td>
			                                <?php echo $lahan_norma['nama_lahan'] ?>
			                            </td>
			                            <td>
			                                <?php echo $lahan_norma['alamat'] ?>
			                            </td>
			                            @foreach($kriteria as $items)
			                            <td>
			                                <?php echo $lahan_norma[$items->id_kriteria] ?>
			                            </td>
			                            @endforeach
			                            <td>
			                                <?php echo $lahan_norma['hasil'] ?>
			                            </td>
			                        </tr>
                                   {{-- @if ($lahan_norma['hasil'] == 'Tidak Layak' || $lahan_norma['hasil'] === 'Tidak layak')
                                     <tr>
                                         <td >Keterangan</td>
                                         <td colspan="{{ count($kriteria) }}">{{ implode(',',$validasi_data) }}</td>
                                     </tr>
                                   @endif --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
