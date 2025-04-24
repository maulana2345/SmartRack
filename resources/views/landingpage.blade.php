@extends('layouts.main')

@section('container')

    <!-- ======== preloader start ======== -->
    <div class="preloader">
        <div class="loader">
            <div class="spinner">
                <div class="spinner-container">
                    <div class="spinner-rotator">
                        <div class="spinner-left">
                            <div class="spinner-circle"></div>
                        </div>
                        <div class="spinner-right">
                            <div class="spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- preloader end -->

    <!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center position-relative">
                <div class="col-lg-6" style="margin-top: -60px;">
                    <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                        <img src="{{ asset('assets/img/hero/Gerobak.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-content" style="margin-left: 80px;">
                        <h1 class="wow fadeInUp" data-wow-delay=".4s">
                            Lebih Cepat,
                            <br>Lebih Rapi,
                            <br>Lebih Smart!
                        </h1>
                        <p class="wow fadeInUp" data-wow-delay=".6s">
                            SmartRack: Sistem manajemen gudang berbasis AI yang membuat gudang lebih rapi, efisien, dan
                            produktif. Lebih cepat, lebih rapi, lebih smart!
                        </p>
                        <a href="/dashboard" class="main-btn border-btn btn-hover wow fadeInUp" data-wow-delay=".6s">Mulai
                            Sekarang!</a>
                        <!-- <a href="#features" class="scroll-bottom">
                                                        <i class="lni lni-arrow-down"></i
                                                        ></a> -->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======== hero-section end ======== -->

    <!-- ======== Feature Bar (Final UI Style) ======== -->
    <section class="feature-bar" style="margin-top: -60px;">
        <div class="container">
            <div class="bg-white shadow-sm py-4 px-3 d-flex justify-content-around flex-wrap" style="border-radius: 12px;">

                <!-- Item 1 -->
                <div class="feature-item d-flex align-items-start px-3 py-2" style="min-width: 260px;">
                    <div class="wow fadeInUp" data-wow-delay=".2s">
                        <img src="{{ asset('assets/img/hero/bintang.png') }}" style="height: 70px; margin-right: 16px;" />
                    </div>
                    <div class="d-flex flex-column">
                        <h4 class="fw-bold text-dark wow fadeInUp" data-wow-delay=".2s">Integrasi AI</h4>
                        <p class="text-secondary wow fadeInUp" data-wow-delay=".2s" style="font-size: medium">Metode Fuzzy
                            sebagai</p>
                        <p class="text-secondary wow fadeInUp" data-wow-delay=".2s" style="font-size: medium">penentu lokasi
                            penyimpanan</p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="feature-item d-flex align-items-start px-3 py-2" style="min-width: 260px;">
                    <div class="wow fadeInUp" data-wow-delay=".2s">
                        <img src="{{ asset('assets/img/hero/tampilan.png') }}" style="height: 70px; margin-right: 16px;" />
                    </div>
                    <div class="d-flex flex-column">
                        <h4 class="fw-bold text-dark wow fadeInUp" data-wow-delay=".2s">Tampilan User Friendly</h4>
                        <p class="text-secondary wow fadeInUp" data-wow-delay=".2s" style="font-size: medium">Menyuguhkan
                            fungsi yang mudah</p>
                        <p class="text-secondary wow fadeInUp" data-wow-delay=".2s" style="font-size: medium">dijangkau
                            pengguna</p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="feature-item d-flex align-items-start px-3 py-2" style="min-width: 260px;">
                    <div class="wow fadeInUp" data-wow-delay=".2s">
                        <img src="{{ asset('assets/img/hero/petir.png') }}" style="height: 70px; margin-right: 16px;" />
                    </div>
                    <div class="d-flex flex-column">
                        <h4 class="fw-bold text-dark wow fadeInUp" data-wow-delay=".2s">Real Time Support</h4>
                        <p class="text-secondary wow fadeInUp" data-wow-delay=".2s" style="font-size: medium">Memberikan
                            layanan dengan</p>
                        <p class="text-secondary wow fadeInUp" data-wow-delay=".2s" style="font-size: medium">cepat tanpa
                            hambatan</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======== about2-section start ======== -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content">
                        <div class="section-title mb-30">
                            <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                                Mari Kenalan Dengan SmartRack!
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay=".4s">
                                SmartRack hadir sebagai solusi cerdas untuk mitra bisnis Anda,
                                dirancang khusus untuk mengoptimalkan manajemen gudang
                                dengan teknologi berbasis Artificial Intelligence.
                            </p>
                        </div>
                        <ul>
                            <li>Waktu Peletakan Barang Lebih Cepat</li>
                        </ul>
                        <ul>
                            <li>Operasional Lebih Produktif</li>
                        </ul>
                        <ul>
                            <li>Susunan Barang Lebih Rapi dan Terorganisir</li>
                        </ul>
                        <!-- <a href="javascript:void(0)" class="main-btn btn-hover border-btn wow fadeInUp"
                                                            data-wow-delay=".6s">Learn More</a> -->
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 order-first order-lg-last">
                    <div class="about-img-2">
                        <img src="{{ asset('assets/images/login_gudang.jpg') }}" alt="" class="w-100" />
                        <!-- <img src="assets/img/about/about-right-shape.svg" alt="" class="shape shape-1" /> -->
                        <!-- <img src="assets/img/about/right-dots.svg" alt="" class="shape shape-2" /> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== about2-section end ======== -->

    <!-- ======== feature-section alur start ======== -->
    <section id="why" class="feature-extended-section">
        <div class="feature-extended-wrapper">
        </div>
    </section>
    <!-- ======== feature-section alur end ======== -->

    <!-- ======== feature-section start ======== -->
    <section id="features" class="feature-section">
        <div class="container">
        </div>
    </section>
    <!-- ======== feature-section end ======== -->


    <!-- ======== feature-section alur start ======== -->
    <section id="why" class="feature-extended-alur-section">
        <div class="feature-extended-alur-wrapper">
            <div class="container position-relative" style="z-index: 2;">
                <div class="row justify-content-center">
                    <div class="col-xxl-8 col-xl-10 col-lg-10 col-md-12">
                        <div class="section-title text-center mb-2">
                            <p class="wow fadeInUp" data-wow-delay=".2s" style="color: #fff">
                                Tentang
                            </p>
                            <h2 class="wow fadeInUp" data-wow-delay=".4s" style="color: #fff">
                                CodeCrafters Studio
                            </h2>
                        </div>
                    </div>
                    <p class="wow fadeInUp" data-wow-delay=".2s" style="color: #fff; text-align: justify;">
                        CodeCrafters Studio merupakan sebuah perusahaan yang lahir dari semangat mahasiswa untuk
                        berinovasi dan memberikan nilai tambah bagi masyarakat. Kami bermula dari sekelompok
                        mahasiswa
                        yang memiliki visi untuk membantu banyak orang dalam pembuatan website dan aplikasi mobile
                        yang
                        inovatif dan berkualitas. Terciptanya CodeCrafters Studio pada tahun 2022 adalah hasil dari
                        keinginan kami untuk berkontribusi dalam dunia teknologi informasi. Meskipun berasal dari
                        latar
                        belakang yang beragam, kami memiliki satu visi yang sama yaitu memberikan solusi teknologi
                        terbaik
                        bagi klien kami.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== feature-section alur end ======== -->

    <!-- ======== feature-section start ======== -->
    <!-- <section id="why" class="feature-extended-section pt-10">
                                    <div class="feature-extended-wrapper">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-xxl-8 col-xl-10 col-lg-10 col-md-12">
                                                    <div class="section-title text-center mb-60">
                                                        <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                                                            Frequently Asked Questions
                                                        </h2>
                                                        <p class="wow fadeInUp" data-wow-delay=".4s">
                                                            Berikut adalah beberapa pertanyaan yang sering diajukan oleh
                                                            pengguna.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="accordion">
                                                1. pertanyaan
                                            </button>
                                            <div class="panel">
                                                <p style="font-size: medium">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi sint similique tenetur incidunt
                                                    molestiae consequatur maiores harum odit odio exercitationem sunt pariatur iure quasi excepturi
                                                    eaque eveniet, rerum necessitatibus veritatis?
                                                </p>
                                            </div>

                                            <button class="accordion">
                                                2. pertanyaan
                                            </button>
                                            <div class="panel">
                                                <p style="font-size: medium">
                                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi harum quasi temporibus ullam animi
                                                    numquam necessitatibus voluptas ipsum eligendi, quam quisquam blanditiis aliquam fugit perferendis
                                                    nesciunt, autem doloribus, exercitationem sunt!
                                                </p>
                                            </div>

                                            <button class="accordion">
                                                3. pertanyaan
                                            </button>
                                            <div class="panel">
                                                <p style="font-size: medium">
                                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti, libero? Amet nobis aut quam.
                                                    Explicabo molestias officiis error consectetur impedit possimus, rem perspiciatis veritatis
                                                    distinctio quidem nisi odit. Libero, quos.
                                                </p>
                                            </div>

                                            <button class="accordion">4. pertanyaan</button>
                                            <div class="panel">
                                                <p style="font-size: medium">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla sapiente provident magni cumque
                                                    repellendus consectetur dolores laborum magnam, assumenda dicta perspiciatis nostrum, mollitia aut
                                                    illo incidunt atque repudiandae! Dolorem, nihil!
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </section> -->
    <!-- ======== feature-section end ======== -->
@endsection