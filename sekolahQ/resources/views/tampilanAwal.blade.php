<!doctype html>
<html lang="en">
<!--

Page    : index / MobApp
Version : 1.0
Author  : Colorlib
URI     : https://colorlib.com

 -->

<head>
    <title>MobApp - App Landing Page Template</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Mobland - Mobile App Landing Page Template">
    <meta name="keywords" content="HTML5, bootstrap, mobile, app, landing, ios, android, responsive">

    <!-- Font -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="home/css/bootstrap.min.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="home/css/themify-icons.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="home/css/owl.carousel.min.css">
    <!-- Main css -->
    <link href="home/css/style.css" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="30">

    <!-- Nav Menu -->

    <header class="bg-gradient"  id="home">
        <div class="container mt-5">
            <h1>SekolahQ</h1>
            <p class="tagline">Temukan SekolahMu</p>
        </div>
        <div class="img-holder mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <a href="#">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-face-smile gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <a href="{{ route('peta.index') }}">
                                    <h4 class="card-title">SD </h4> 

                                    <p class="card-text">Sekolah Dasar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-12 col-lg-4">
                        <a href="#">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-settings gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                <a href="{{ route('peta.index') }}">
                                    <h4 class="card-title">SMP</h4>
                                    <p class="card-text">Sekolah Menengah Pertama</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-12 col-lg-4">
                        <a href="#">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-lock gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                <a href="{{ route('peta.index') }}">
                                    <h4 class="card-title">SMA</h4>
                                    <p class="card-text">Sekolah Menengah Atas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            <!-- </div> -->
            </div>
        </div>
    </header>
    <!-- jQuery and Bootstrap -->
    <script src="{{ asset('home/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('home/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Plugins JS -->
    <script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('home/js/script.js') }}"></script>

</body>

</html>
