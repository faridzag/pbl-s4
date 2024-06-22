@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <!-- Blade: Fullscreen Background -->
    <div class="position-relative vh-100">
        <!-- Gambar Latar Belakang dengan Blur -->
        <img src="{{asset('admin/img/background-gedung.jpg')}}" class="position-absolute w-100 h-100" style="object-fit: cover; filter: blur(3px);" alt="Background">
    </div>

    <!-- Blade: Job Fair Yang Berlangsung -->
    <div class="container-fluid bg-light" id="content" style="margin-top: 50px;">
        <div class="container py-5">
            <div class="d-flex justify-content-between mb-4">
                <h2>Job Fair Akan Datang</h2>
                <a href="#" class="btn btn-primary">Lihat Lebih Banyak</a>
            </div>
            
            <div class="row justify-content-center">
                <!-- Kotak 1 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="https://via.placeholder.com/400x150" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Senin 27 Mei 2024 | 08.00</p>
                            <h5 class="card-title">Job Fair 2024</h5>
                            <span><i class="fas fa-map-marker-alt mr-2"></i>Banyuwangi, Jawa Timur</span>
                        </div>
                    </div>
                </div>
                <!-- Kotak 2 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="https://via.placeholder.com/400x150" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Senin 27 Mei 2024 | 08.00</p>
                            <h5 class="card-title">Job Fair 2024</h5>
                            <span><i class="fas fa-map-marker-alt mr-2"></i>Banyuwangi, Jawa Timur</span>
                        </div>
                    </div>
                </div>
                <!-- Kotak 3 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="https://via.placeholder.com/400x150" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Senin 27 Mei 2024 | 08.00</p>
                            <h5 class="card-title">Job Fair 2024</h5>
                            <span><i class="fas fa-map-marker-alt mr-2"></i>Banyuwangi, Jawa Timur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blade: Perusahaan Terdaftar -->
    <div class="container-fluid bg-light" id="perusahaan-terdaftar" style="margin-top: 50px;">
        <div class="container py-5">
            <div class="d-flex justify-content-between mb-4">
                <h2>Perusahaan Terdaftar</h2>
                <a href="#" class="btn btn-primary">Lihat Lebih Banyak</a>
            </div>
            <div class="row justify-content-center">
                <!-- Kotak 1 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="https://via.placeholder.com/400x150" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text"><strong>PT. Pesona Royal Indonesia</strong></p>
                            <p class="card-text">Cosmetic & Beauty Supplies</p>
                            <span><i class="fas fa-map-marker-alt mr-2"></i>Banyuwangi, Jawa Timur</span>
                        </div>
                    </div>
                </div>
                <!-- Kotak 2 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="https://via.placeholder.com/400x150" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text"><strong>PT. Pesona Royal Indonesia</strong></p>
                            <p class="card-text">Cosmetic & Beauty Supplies</p>
                            <span><i class="fas fa-map-marker-alt mr-2"></i>Banyuwangi, Jawa Timur</span>
                        </div>
                    </div>
                </div>
                <!-- Kotak 3 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="https://via.placeholder.com/400x150" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text"><strong>PT. Pesona Royal Indonesia</strong></p>
                            <p class="card-text">Cosmetic & Beauty Supplies</p>
                            <span><i class="fas fa-map-marker-alt mr-2"></i>Banyuwangi, Jawa Timur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection