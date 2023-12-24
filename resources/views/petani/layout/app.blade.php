<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Sistem Informasi Internal Rumah Sakit" />
        <meta name="author" content="SIS INTERNAL RS" />
        <meta name="keywords" content="" />

        <link rel="preconnect" href="https://fonts.gstatic.com" />

        <link rel="icon" type="image/x-icon" href="{{asset('img/porang.png')}}">

        <title>{{@$title}}</title>

        <link href="{{asset('css/light.css')}}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
        <link href="{{ asset('swal/dist/sweetalert2.min.css') }}" rel="stylesheet">
        <style type="text/css">
            .badge {
                display: inline-block;
                padding: 0.25em 0.4em;
                font-size: 75%;
                font-weight: 700;
                line-height: 1;
                text-align: center;
                white-space: nowrap;
                vertical-align: baseline;
                border-radius: 0.25rem;
            }
            .badge-success {
                color: #fff;
                background-color: #28a745;
            }
            .badge-danger {
                color: #fff;
                background-color: #dc3545;
            }
        </style>
    </head>
    <?php
                        $data_akses = array();
                        $indikator_mutu = 0;
                        $ikp = 0;
                        $rkk = 0;
                        $informasi = 0;
                        $dokumen = 0;
                        if(Session::get('hak_akses')){
                            $data_akses = explode(", ", Session::get('hak_akses'));

                            $indikator_mutu_s = 'Indikator Mutu';
                            $ikp_s = 'Insiden Keselamatan Pasien';
                            $rkk_s = 'Rincian Kewenangan Klinis';
                            $informasi_s = "Informasi";
                            $dokumen_s = "Dokumen";
                            foreach ($data_akses as $akses) {
                                //if (strstr($string, $url)) { // mine version
                                if (strpos($akses, $indikator_mutu_s) !== FALSE) { // Yoshi version
                                    $indikator_mutu = 1;
                                }
                                if (strpos($akses, $ikp_s) !== FALSE) { // Yoshi version
                                    $ikp = 1;
                                }
                                if (strpos($akses, $rkk_s) !== FALSE) { // Yoshi version
                                    $rkk = 1;
                                }
                                if (strpos($akses, $informasi_s) !== FALSE) { // Yoshi version
                                    $informasi = 1;
                                }
                                if (strpos($akses, $dokumen_s) !== FALSE) { // Yoshi version
                                    $dokumen = 1;
                                }
                            }
                        }
                        ?>
    <body>
        <div class="wrapper">
            <nav id="sidebar" class="sidebar js-sidebar">
                <div class="sidebar-content js-simplebar">
                    <a class="sidebar-brand" href="{[route('admin.dashaboard')]}">
                        <span class="align-middle">Bibit Cabai</span>
                    </a>

                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Halaman Petani
                        </li>

                        <li class="sidebar-item <?= Request::segment(2) == '' ? 'active' : '' ?>">
                            <a class="sidebar-link" href="{{route('petani.dashboard')}}"> <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Beranda</span> </a>
                        </li>
                        <li class="sidebar-item <?= Request::segment(2) == 'lahan' ? 'active' : '' ?>">
                            <a class="sidebar-link" href="{{route('petani.lahan')}}"> <i class="fa fa-database"></i> <span class="align-middle">Data Cabai</span> </a>
                        </li>
                        <li class="sidebar-item <?= Request::segment(2) == 'history' ? 'active' : '' ?>">
                            <a class="sidebar-link" href="{{route('petani.lahan.history')}}"> <i class="fa fa-list"></i> <span class="align-middle">Riwayat Pengujian</span> </a>
                        </li>
                        <li class="sidebar-item <?= Request::segment(2) == 'password' ? 'active' : '' ?>">
                            <a class="sidebar-link" href="{{route('petani.password')}}"> <i class="fa fa-lock"></i> <span class="align-middle">Setting Password</span> </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main">
                <nav class="navbar navbar-expand navbar-light navbar-bg">
                    <a class="sidebar-toggle js-sidebar-toggle">
                        <i class="hamburger align-self-center"></i>
                    </a>
                    <div class="navbar-collapse collapse">
                        <ul class="navbar-nav navbar-align">
                            <li class="nav-item dropdown">
                                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                    <i class="align-middle" data-feather="settings"></i>
                                </a>
                                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                    <img src="{{asset('img/user.png')}}" class="avatar img-fluid rounded me-1" alt="{{Session::get('user')}}" />
                                    <span class="text-dark">{{Session::get('user')}}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('keluar') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                                    <form id="logout-form" action="{{ route('keluar') }}" method="POST" style="display: none;">
                                        @csrf
                                      </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                @yield('content')

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-12 text-start">
                                <p class="mb-0">
                                    Copyright © KNN Bibit Cabai {{date('Y')}}
                                </p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="{{asset('js/app.js')}}"></script>

        <script src="{{asset('js/datatables.js')}}"></script>

        <link href="{{asset('select2/select2.min.css')}}" rel="stylesheet" type="text/css">
        <script src="{{asset('select2/select2.min.js')}}"></script>
        <script src="{{ asset('swal/dist/sweetalert2.min.js') }}"></script>
        <style type="text/css">
        .select2-selection__rendered {
            line-height: calc(2.25rem + 2px) !important;
            border-top-color: rgb(209, 211, 226);
            border-right-color: rgb(209, 211, 226);
            border-bottom-color: rgb(209, 211, 226);
            border-left-color: rgb(209, 211, 226);
        }
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px) !important;
            border-top-color: rgb(209, 211, 226);
            border-right-color: rgb(209, 211, 226);
            border-bottom-color: rgb(209, 211, 226);
            border-left-color: rgb(209, 211, 226);
        }
        .select2-selection__arrow {
            height: calc(2.25rem + 2px) !important;
            border-top-color: rgb(209, 211, 226);
            border-right-color: rgb(209, 211, 226);
            border-bottom-color: rgb(209, 211, 226);
            border-left-color: rgb(209, 211, 226);
        }
    </style>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Datatables Responsive
                $("#datatables-reponsive").DataTable({
                    responsive: true
                });
            });
        </script>
        @stack('custom-scripts')
    </body>
</html>
