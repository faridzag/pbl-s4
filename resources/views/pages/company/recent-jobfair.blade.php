@extends('layouts.main')

@section('title', 'Job Fair Perusahaan')

@section('content')
<div class="py-5" style="background-color: #D3E1E9;">
    <div class="container">
        <div class="row align-items-center text-center text-md-start">
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="{{asset('img/somethinc-logo.jpeg')}}" alt="Perusahaan" width="280" height="280" class="img-fluid mx-auto mx-md-0">
            </div>
            <div class="col-md-8 mt-5">
                <div class="text-container">
                    <h3 class="mb-1">PT. PESONA ROYAL INDONESIA</h3>
                    <p class="text-warning mb-1">Manufaktur dan Distribusi Kosmetik dan Produk Kecantikan</p>
                    <p class="text-secondary mb-5"><i class="bi bi-geo-alt-fill"></i> Bali Convention Center, Nusa Dua, Bali</p>
                    <a href="https://poliwangi.ac.id/" target="_blank" class="btn border-secondary me-2 nav-hover">PROFIL</a>
                    <a href="https://poliwangi.ac.id/" target="_blank" class="btn border-secondary nav-hover">JOB FAIR</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Job Fair Section -->
<div class="bg-white py-5">
    <div class="container">
        <h2 class="mb-5 text-start">Job Fair</h2>
        <div class="row g-4">
            <div class="col-12">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-1">
                            <img src="{{asset('admin/img/campus-hiring.jpg')}}" alt="Job Fair Image" class="img-fluid rounded-start ms-2 mt-2" style="width: 100px; height: auto;">
                        </div>

                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title text-warning small">Manufaktur dan Distribusi Kosmetik dan Produk Kecantikan</h5>
                                <p class="card-text fw-bold small">Beauty & Wellness Career Fair 2024</p>
                                <p class="card-text small"><i class="bi bi-clock-fill"></i> Senin, 10 Agustus 2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-1">
                            <img src="{{asset('admin/img/campus-hiring.jpg')}}" alt="Job Fair Image" class="img-fluid rounded-start ms-2 mt-2" style="width: 100px; height: auto;">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title text-warning small">Manufaktur dan Distribusi Kosmetik dan Produk Kecantikan</h5>
                                <p class="card-text fw-bold small">Beauty & Wellness Career Fair 2024</p>
                                <p class="card-text small"><i class="bi bi-clock-fill"></i> Senin, 10 Agustus 2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Additional cards can be added here in similar structure -->
        </div>

    <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            </ul>
        </nav>
    </div>
</div>
@endsection