<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>K-NEAREST NEIGHBOR - Bibit Cabai</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('aos%403.0.0-beta.6/dist/aos.css') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('img/porang.png') }}" />
    <script data-search-pseudo-elements="" defer="" src="{{ asset('ajax/libs/font-awesome/6.4.0/js/all.min.js') }}"
        crossorigin="anonymous"></script>
    <script src="{{ asset('ajax/libs/feather-icons/4.29.0/feather.min.js') }}" crossorigin="anonymous"></script>
</head>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <!-- Navbar-->
                <nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
                    <div class="container px-5">
                        <a class="navbar-brand text-white" href="{{ route('index') }}">Bibit Cabai</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            {{-- <ul class="navbar-nav ms-auto me-lg-5">
                                    <li class="nav-item"><a class="nav-link" href="{{route('index')}}">Home</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('index')}}">Informasi</a></li>
                                </ul> --}}
                            {{-- <a class="btn fw-500 ms-lg-4 btn-danger" href="{{route('masuk')}}">
                                    Masuk
                                    <i class="ms-2" data-feather="arrow-right"></i>
                                </a> --}}
                        </div>
                    </div>
                </nav>
                <!-- Page Header-->
                <header class="page-header-ui page-header-ui-dark">
                    <div class="page-header-ui-content pt-10">
                        <div class="container px-5">
                            <div class="row gx-5 align-items-center">
                                <div class="col-lg-6" data-aos="fade-up">
                                    <h1 class="page-header-ui-title">IMPLEMENTASI ALGORITMA K-NEAREST NEIGHBOR (KNN)
                                    </h1>
                                    <p class="page-header-ui-text mb-5">Untuk Pemilihan Bibit Cabai</p>
                                    <a class="btn btn-danger fw-500 me-2" href="{{ route('daftar') }}">
                                        Daftar
                                        <i class="ms-2" data-feather="arrow-right"></i>
                                    </a>
                                    <a class="btn fw-500 ms-lg-4 btn-danger" href="{{ route('masuk') }}">
                                        Masuk
                                        <i class="ms-2" data-feather="arrow-right"></i>
                                    </a>
                                </div>
                                <div class="col-lg-6 d-none d-lg-block" data-aos="fade-up" data-aos-delay="100"><img
                                        class="img-fluid" src="img/pngegg.png" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-white">
                        <!-- Rounded SVG Border-->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none"
                            fill="currentColor">
                            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                        </svg>
                    </div>
                </header>
                <hr class="m-0" />
            </main>
        </div>
        <div id="layoutDefault_footer">
            <footer class="footer pt-10 pb-5 mt-auto bg-light footer-light">
                <div class="container px-5">
                    <hr class="my-5" />
                    <div class="row gx-5 align-items-center">
                        <div class="col-md-6 small">Copyright © KNN Bibit Cabai {{ date('Y') }}</div>
                        <div class="col-md-6 text-md-end small">
                            <a href="#!">Privacy Policy</a>
                            ·
                            <a href="#!">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('bootstrap%405.2.3/dist/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('aos%403.0.0-beta.6/dist/aos.js') }}"></script>
    <script>
        AOS.init({
            disable: 'mobile',
            duration: 600,
            once: true,
        });
    </script>

    <script src="{{ asset('js/sb-customizer.js') }}"></script>
</body>

</html>
