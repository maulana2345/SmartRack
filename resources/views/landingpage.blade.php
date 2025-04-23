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
        <div class="col-lg-6">
                <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                    <img src="assets/img/hero/Gerobak.png" alt="" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-content" style="margin-left: 80px;">
                    <h1 class="wow fadeInUp" data-wow-delay=".4s">
                        Lebih Cepat,
                        Lebih Rapi,
                        Lebih Smart!
                    </h1>
                    <p class="wow fadeInUp" data-wow-delay=".6s">
                    SmartRack: Sistem manajemen gudang berbasis AI yang membuat gudang lebih rapi, efisien, dan produktif. Lebih cepat, lebih rapi, lebih smart!
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

<!-- ======== Feature Bar ======== -->
<section class="feature-bar" style="margin-top: -60px;">
    <div class="container">
        <div class="bg-white shadow-sm rounded py-4 px-3 d-flex justify-content-around text-center flex-wrap" style="border-radius: 12px;">
            
            <!-- Item 1 -->
            <div class="feature-item px-3 py-2" style="min-width: 260px;">
                <div class="mb-2">
                    <!-- Icon Star (Simple SVG) -->
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#999" viewBox="0 0 24 24">
                        <path d="M12 2l2.39 7.26H22l-6 4.36 2.39 7.26L12 16.52l-6.39 4.36L8 13.62 2 9.26h7.61z"/>
                    </svg> -->
                </div>
                <h6 class="fw-bold text-dark">Integrasi AI</h6>
                <p class="text-secondary small">Metode Fuzzy sebagai penentu lokasi penyimpanan</p>
            </div>

            <!-- Item 2 -->
            <div class="feature-item px-3 py-2" style="min-width: 260px;">
                <div class="mb-2">
                    <!-- Icon Check -->
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#999" viewBox="0 0 24 24">
                        <path d="M9 16.2l-4.2-4.2-1.4 1.4 5.6 5.6 12-12-1.4-1.4z"/>
                    </svg> -->
                </div>
                <h6 class="fw-bold text-dark">Tampilan User Friendly</h6>
                <p class="text-secondary small">Menyuguhkan fungsi yang mudah dijangkau pengguna</p>
            </div>

            <!-- Item 3 -->
            <div class="feature-item px-3 py-2" style="min-width: 260px;">
                <div class="mb-2">
                    <!-- Icon Lightning -->
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#999" viewBox="0 0 24 24">
                        <path d="M7 2v10h3v10l7-12h-4l4-8z"/>
                    </svg> -->
                </div>
                <h6 class="fw-bold text-dark">Real Time Support</h6>
                <p class="text-secondary small">Memberikan layanan dengan cepat tanpa hambatan</p>
            </div>

        </div>
    </div>
</section>


<!-- ======== feature-section start ======== -->
<section id="features" class="feature-section pt-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-grid-alt"></i>
                    </div>
                    <div class="content">
                        <h3>Integrasi AI</h3>
                        <p>
                            Menggunakan model kecerdasan buatan untuk menentukan lokasi penyimpanan barang.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-layout"></i>
                    </div>
                    <div class="content">
                        <h3>Tampilan User Friendly</h3>
                        <p>
                        Menyuguhkan fungsi yang mudah
                        dijangkau pengguna
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-coffee-cup"></i>
                    </div>
                    <div class="content">
                        <h3>Real Time Support</h3>
                        <p>
                        Memberikan layanan dengan
                        cepat tanpa hambatan 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-leaf"></i>
                    </div>
                    <div class="content">
                        <h3>Waktu Peletakan Barang Lebih Cepat</h3>
                        <p>
                        Tidak perlu lagi buang waktu mencari lokasi penyimpanan. SmartRack mengatur 
                        semuanya dengan presisi.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-rocket"></i>
                    </div>
                    <div class="content">
                        <h3>Operasional Lebih Produktif</h3>
                        <p>
                        Dengan sistem yang terotomatisasi, tim Anda bisa fokus pada tugas-tugas penting lainnya.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-layers"></i>
                    </div>
                    <div class="content">
                        <h3>Susunan Barang Lebih Rapi dan Terorganisir</h3>
                        <p>
                        Gudang Anda akan selalu tertata rapi, memudahkan pencarian dan pengambilan 
                        barang.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======== feature-section end ======== -->

<!-- ======== feature-section start ======== -->
<section id="why" class="feature-extended-section pt-100">
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
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi sint similique tenetur incidunt molestiae consequatur maiores harum odit odio exercitationem sunt pariatur iure quasi excepturi eaque eveniet, rerum necessitatibus veritatis?
                </p>
            </div>

            <button class="accordion">
                2. pertanyaan
            </button>
            <div class="panel">
                <p style="font-size: medium">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi harum quasi temporibus ullam animi numquam necessitatibus voluptas ipsum eligendi, quam quisquam blanditiis aliquam fugit perferendis nesciunt, autem doloribus, exercitationem sunt!
                </p>
            </div>

            <button class="accordion">
                3. pertanyaan
            </button>
            <div class="panel">
                <p style="font-size: medium">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti, libero? Amet nobis aut quam. Explicabo molestias officiis error consectetur impedit possimus, rem perspiciatis veritatis distinctio quidem nisi odit. Libero, quos.
                </p>
            </div>

            <button class="accordion">4. pertanyaan</button>
            <div class="panel">
                <p style="font-size: medium">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla sapiente provident magni cumque repellendus consectetur dolores laborum magnam, assumenda dicta perspiciatis nostrum, mollitia aut illo incidunt atque repudiandae! Dolorem, nihil!
                </p>
            </div>

        </div>
    </div>
</section>
<!-- ======== feature-section end ======== -->
@endsection