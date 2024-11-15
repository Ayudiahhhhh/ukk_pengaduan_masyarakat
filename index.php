<?php
include './layouts_landing/header.php';
?>


<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">Ngaduuu</h1>
                <span>!!!</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#bg" class="active">Home<br></a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="bg" class="hero section light-background">

            <div class="container">
                <div class="row gy-4 justify-content-center justify-content-lg-between">
                    <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 data-aos="fade-up">Selamat datang di pengaduan masyarakat</h1>
                        <p data-aos="fade-up" data-aos-delay="100">keluarkan semua unek-unek disini</p>
                        <div class="d-grid gap-2 d-md-block">
                            <a href="<?= BASE_URL ?>auth/login" class="btn btn-primary">laporkan !!!</a>
                        </div>
                    </div>
                    <div class="col-lg-5 order-1 order-lg-2 aduan data-aos=" zoom-out">
                        <img src="<?= ASSETS_PATH ?>/landing/img/aduan.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->


        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>


        <?php
        include './layouts_landing/footer.php';
        ?>