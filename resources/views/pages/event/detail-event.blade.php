@extends('layouts.main')

@section('title', 'Tentang Job Fair')

@section('content')
    <div class="py-5" style="background-color: #D3E1E9;">
        <div class="container">
            <div class="row align-items-center text-center text-md-start">
                <div class="col-md-4 mb-3 mb-md-0">
                    <img src="{{asset('img/campus-hiring.jpg')}}" class="img-fluid mx-auto mx-md-0" alt="Event Image">
                </div>
                <div class="col-md-8 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                    <div class="text-container text-center text-md-start">
                        <h1 class="h4 font-weight-bold">Bali Career Expo 2024</h1>
                        <p class="small"><i class="fas fa-map-marker-alt"></i> Bali Convention Center, Nusa Dua, Bali</p>
                        <p class="small"><i class="fas fa-calendar-alt"></i> 15 Juli 2024 - 17 Juli 2024</p>
                        <p class="small"><i class="fas fa-clock"></i> 09.00 - 17.00 WITA</p>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center justify-content-md-start mt-4" style="gap: 5px;">
                        <div class="border border-black rounded pt-1 pb-1 text-center" style="width: 150px;">
                            <h6 class="fw-bold small mb-1">Lowongan Kerja</h6>
                            <p class="text-warning small mb-0">5</p>
                        </div>
                        <div class="border border-black rounded pt-1 pb-1 text-center" style="width: 150px;">
                            <h6 class="fw-bold small mb-1">Perusahaan</h6>
                            <p class="text-warning small mb-0">4</p>
                        </div>
                        <div class="border border-black rounded pt-1 pb-1 text-center" style="width: 150px;">
                            <h6 class="fw-bold small mb-1">Pencari Kerja</h6>
                            <p class="text-warning small mb-0">57</p>
                        </div>
                    </div>

                    <div class="mt-2 text-center text-md-start">
                        <button class="btn btn-primary btn-md">Masuk Untuk Mengikuti</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fitur Baru Section -->
    <div class="bg-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="font-weight-bold mb-4">Tentang Bali Career Expo 2024</h2>
                    <p>Bali Career Expo 2024 adalah pameran karir tahunan terbesar di Bali yang menyediakan kesempatan bagi pencari kerja untuk bertemu langsung dengan perusahaan-perusahaan terkemuka dari berbagai sektor industri. Selain itu, job fair ini juga menawarkan berbagai workshop dan seminar tentang pengembangan karir, tips membuat CV, dan teknik wawancara. Pencari kerja juga dapat mengikuti sesi networking untuk memperluas koneksi profesional mereka.</p>
                    
                    <h3 class="font-weight-bold">Keuntungan Mengikuti Bali Career Expo 2024:</h3>
                    <ul>
                        <li>Peluang untuk wawancara langsung dengan perusahaan peserta</li>
                        <li>Informasi terkini tentang lowongan kerja dan industri</li>
                        <li>Sesi mentoring dan coaching dari para ahli karir</li>
                        <li>Pengembangan keterampilan melalui berbagai workshop dan seminar</li>
                    </ul>
                
                    <h3 class="font-weight-bold">Lowongan Kerja:</h3>
                    <ol>
                        <li>Marketing Manager</li>
                        <li>Software Developer</li>
                        <li>Customer Service Representative</li>
                        <li>Graphic Designer</li>
                        <li>Human Resources Specialists</li>
                    </ol>
                </div>

                <div class="col-md-6">
                    <h2 class="text-center font-weight-bold mb-4">Daftar Perusahaan Peserta</h2>
                    <div class="mb-3 text-center">
                        <div class="mb-3">
                        <img src="{{asset('admin/img/somethinc-logo.jpeg')}}" alt="Company Logo" class="mr-2" style="width: 80px; height: 80px; display: inline-block;">
                            <div style="display: inline-block; vertical-align: middle;">
                                <h6 class="font-weight-bold">PT. Tech Innovators</h6>
                                <p class="text-warning" style="text-align: left;">45 Lowongan</p>
                            </div>
                        </div>
                        <hr style="border: 1px solid black; width: 65%; margin: 10px auto;">
                    
                        <div class="mb-3">
                        <img src="{{asset('admin/img/somethinc-logo.jpeg')}}" alt="Company Logo" class="mr-2" style="width: 80px; height: 80px; display: inline-block;">
                            <div style="display: inline-block; vertical-align: middle;">
                                <h6 class="font-weight-bold">PT. Tech Innovators</h6>
                                <p class="text-warning" style="text-align: left;">45 Lowongan</p>
                            </div>
                        </div>
                        <hr style="border: 1px solid black; width: 65%; margin: 10px auto;">
                    
                        <div class="mb-3">
                        <img src="{{asset('admin/img/somethinc-logo.jpeg')}}" alt="Company Logo" class="mr-2" style="width: 80px; height: 80px; display: inline-block;">
                        <div style="display: inline-block; vertical-align: middle;">
                            <h6 class="font-weight-bold">PT. Tech Innovators</h6>
                            <p class="text-warning" style="text-align: left;">45 Lowongan</p>
                        </div>
                        </div>
                        <hr style="border: 1px solid black; width: 65%; margin: 10px auto;">
                    
                        <div class="mb-3">
                        <img src="{{asset('admin/img/somethinc-logo.jpeg')}}" alt="Company Logo" class="mr-2" style="width: 80px; height: 80px; display: inline-block;">
                        <div style="display: inline-block; vertical-align: middle;">
                            <h6 class="font-weight-bold">PT. Tech Innovators</h6>
                            <p class="text-warning" style="text-align: left;">45 Lowongan</p>
                        </div>
                        </div>
                    </div>
                
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">»</span>
                        </a>
                    </li>
                    </ul>
                </nav>
                </div>
            </div>
        </div>
    </div>
@endsection