<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi Internal Rumah Sakit" />
    <meta name="author" content="SIS INTERNAL RS" />
    <meta name="keywords" content="">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('img/porang.png') }}" />

    <title>{{ @$title }}</title>

    <link href="{{ asset('css/light.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Selamat Datang</h1>
                            <p class="lead">
                                IMPLEMENTASI METODE KNN UNTUK PEMILIHAN BIBIT CABAI
                            </p>
                        </div>

                        <div class="card bg-dark">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="{{ asset('img/pngegg.png') }}" alt="Charles Hall"
                                            class="img-fluid rounded-circle" width="132" height="132" />
                                    </div>
                                    @if (session('berhasil'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                            <div class="alert-message">
                                                {{ session('berhasil') }}
                                            </div>
                                        </div>
                                    @endif
                                    @if (session('gagal'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                            <div class="alert-message">
                                                {{ session('gagal') }}
                                            </div>
                                        </div>
                                    @endif
                                    <form action="{{ route('masuk.proses') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label text-white">UserName</label>
                                            <input class="form-control form-control-lg" type="text" name="user"
                                                placeholder="Username" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-white">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="pass"
                                                placeholder="Password" required />
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-danger">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
