<footer class="footer py-5" style="background: linear-gradient(180deg, #ffffff 0%, #D3E1E9 100%);">
    <div class="container">
        <div class="row g-4">
            <!-- Logo Column -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="d-flex flex-column align-items-center align-items-lg-start">
                    <img src="{{asset('img/poliwangi-logo-text-only.svg')}}" alt="Poliwangi" class="mb-3" style="height: 40px;">
                    <div class="d-flex gap-3 mb-3">
                        <img src="{{asset('img/logo-poliwangi.png')}}" alt="Logo Poliwangi" style="height: 60px;">
                        <img src="{{asset('img/ti.png')}}" alt="Logo TI" style="height: 60px;">
                    </div>
                    <p class="text-muted mb-0">Platform Job Fair dan Recruitment Kampus</p>
                </div>
            </div>


            <!-- Location -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 class="fw-bold mb-3">Lokasi</h5>
                <ul class="list-unstyled">
                    <li class="mb-2 d-flex align-items-start">
                        <i class="fab fa-map-marker-alt text-primary mt-1 me-2"></i>
                        <div>
                            <p class="mb-0">Jalan Raya Jember KM 13</p>
                            <p class="mb-0">Banyuwangi 68461</p>
                            <p class="mb-0">Jawa Timur, Indonesia</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">Kontak</h5>
                <ul class="list-unstyled">
                    <li class="mb-2 d-flex align-items-center">
                        <i class="fas fa-phone text-primary me-2"></i>
                        <span>+62 (0333) 636780</span>
                    </li>
                    <li class="mb-2 d-flex align-items-center">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <a href="mailto:poliwangi@poliwangi.ac.id" class="text-decoration-none text-muted hover-primary">
                            poliwangi@poliwangi.ac.id
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row mt-4 pt-4 border-top">
            <div class="col-12 text-center">
                <p class="text-muted mb-0">
                   Copyright © Team Job Fair Poliwangi {{ date('Y') }}
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
.footer {
    position: relative;
    overflow: hidden;
}

.footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: linear-gradient(180deg, rgba(255,255,255,0) 0%, rgba(211,225,233,0.1) 100%);
    pointer-events: none;
}

.hover-primary:hover {
    color: #004878 !important;
    transition: color 0.3s ease;
}

.footer i {
    font-size: 1.1rem;
}
</style>
