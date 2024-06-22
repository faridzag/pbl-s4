@extends('layouts.main')

@section('title', 'Perusahaan')

@section('content')
    <!-- Blade: Fullscreen Background -->
    <div class="position-relative vh-100">
        <!-- Gambar Latar Belakang dengan Blur -->
        <img src="{{asset('img/background-gedung.jpg')}}" class="position-absolute w-100 h-100" style="object-fit: cover; filter: blur(3px);" alt="Background">
    </div>

    <div class="container-fluid bg-light" id="content" style="margin-top: 50px;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <!-- Box 1 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="{{asset('admin/img/somethinc-logo.jpeg')}}" class="card-img-top" alt="CompanyLogo" width="100" height="100" class="d-inline-block align-text-top">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">PT PERSONA ROYAL INDONESIA</h6>
                            <p class="card-text">Cosmetic & Beauty Supplies</p>
                            <span><i class="bi bi-geo-alt-fill"></i></i>Banyuwangi, Jawa Timur</span>
                        </div>
                    </div>
                </div>
                <!-- Box 2 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="{{asset('admin/img/somethinc-logo.jpeg')}}" class="card-img-top"  alt="CompanyLogo" width="100" height="100" class="d-inline-block align-text-top">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">PT PERSONA ROYAL INDONESIA</h6>
                            <p class="card-text">Cosmetic & Beauty Supplies</p>
                            <span><i class="bi bi-geo-alt-fill"></i></i>Banyuwangi, Jawa Timur</span>
                        </div>
                    </div>
                </div>
                <!-- Box 3 -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 rounded shadow">
                        <img src="{{asset('admin/img/somethinc-logo.jpeg')}}" class="card-img-top"  alt="CompanyLogo" width="100" height="100" class="d-inline-block align-text-top">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">PT PERSONA ROYAL INDONESIA</h6>
                            <p class="card-text">Cosmetic & Beauty Supplies</p>
                            <span><i class="bi bi-geo-alt-fill"></i>Banyuwangi, Jawa Timur</span>
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