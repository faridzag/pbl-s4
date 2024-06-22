@extends('layouts.main')

@section('title', 'Kegiatan')

@section('content')
    <!-- Blade: Fullscreen Background -->
    <div class="position-relative vh-100">
        <!-- Gambar Latar Belakang dengan Blur -->
        <img src="{{asset('img/background-gedung.jpg')}}" class="position-absolute w-100 h-100" style="object-fit: cover; filter: blur(3px);" alt="Background">
    </div>

    <div class="container-fluid bg-light mt-1" id="content">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-3 mb-2">
                    <h5 class="fw-bold">Tipe</h5>
                    <select class="form-select mt-2">
                        <option selected>Tipe Job Fair</option>
                        <option value="1">Online</option>
                        <option value="2">Offline</option>
                    </select>
                </div>
                <div class="col-lg-3 mb-2">
                    <h5 class="fw-bold">Tanggal Mulai</h5>
                    <input type="date" class="form-control mt-2">
                </div>
            </div>
            
            <div class="row justify-content-center">
                <!-- Box 1 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="https://via.placeholder.com/400x150" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Senin 27 Mei 2024 | 08.00</p>
                            <h5 class="card-title">Job Fair 2024</h5>
                            <span><i class="fas fa-map-marker-alt me-2"></i>Banyuwangi, Jawa Timur</span>
                        </div>
                    </div>
                </div>
                <!-- Box 2 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="https://via.placeholder.com/400x150" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Senin 27 Mei 2024 | 08.00</p>
                            <h5 class="card-title">Job Fair 2024</h5>
                            <span><i class="fas fa-map-marker-alt me-2"></i>Banyuwangi, Jawa Timur</span>
                        </div>
                    </div>
                </div>
                <!-- Box 3 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="https://via.placeholder.com/400x150" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Senin 27 Mei 2024 | 08.00</p>
                            <h5 class="card-title">Job Fair 2024</h5>
                            <span><i class="fas fa-map-marker-alt me-2"></i>Banyuwangi, Jawa Timur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection