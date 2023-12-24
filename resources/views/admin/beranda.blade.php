@extends('admin.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Dashboard</h1>

        <div class="row">
            <div class="col-sm-3 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Pengguna</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-success">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?php echo @$pengguna; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Kriteria</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-danger">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?php echo @$kriteria; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Nilai Kriteria</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?php echo @$nilai; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Data Latih</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-info">
                                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?php echo @$datalatih; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
