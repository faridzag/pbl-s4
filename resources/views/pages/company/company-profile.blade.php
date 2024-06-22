@extends('layouts.main')

@section('title', 'Profil Perusahaan')

@section('content')
  <div class="py-5" style="background-color: #D3E1E9;">
    <div class="container">
      <div class="row align-items-center text-center text-md-start">
        <div class="col-md-4 mb-3 mb-md-0">
          <img src="{{asset('img/somethinc-logo.jpeg')}}" alt="Perusahaan" width="280" height="280" class="img-fluid position-absolute-left mx-auto mx-md-0">
        </div>
        
        <div class="col-md-8 mt-5">
          <div class="col-md-8 mt-3"> <!-- mengurangi margin atas dari 5 menjadi 3 -->
            <div class="text-container">
              <h3 class="mb-1">PT. PESONA ROYAL INDONESIA</h3> <!-- mengurangi margin bawah dari h3 -->
              <p class="text-warning mb-1">Manufaktur dan Distribusi Kosmetik dan Produk Kecantikan</p> <!-- mengurangi margin bawah dari p -->
              <p class="text-secondary mb-5"><i class="bi bi-geo-alt-fill"></i> Bali Convention Center, Nusa Dua, Bali</p>
              <a href="https://poliwangi.ac.id/" target="_blank" class="btn border-secondary me-2 nav-hover">PROFIL</a>
              <a href="https://poliwangi.ac.id/" target="_blank" class="btn border-secondary nav-hover">JOB FAIR</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white py-5">
    <div class="container">
      <!-- Company Description Section -->
      <div class="row">
        <div class="col-12">
          <h5>Deskripsi Perusahaan</h5>
          <p>
            PT. Pesona Royal Indonesia adalah perusahaan terkemuka di Indonesia yang bergerak di bidang manufaktur dan distribusi kosmetik serta produk kecantikan. Berdiri sejak tahun 2000, perusahaan ini telah berkembang pesat dan dikenal sebagai salah satu produsen kosmetik berkualitas tinggi di Indonesia. Dengan komitmen untuk memberikan produk terbaik bagi konsumen, PT. Pesona Royal Indonesia menggunakan bahan-bahan alami dan teknologi canggih dalam proses produksinya.
          </p>
          <p> Visi: Menjadi perusahaan kosmetik terdepan di Indonesia yang dikensecara global dengan produk berkualitas tinggi dan inovatif.
          </p>
          <p>Misi:
            <ul>
              <li>Menghasilkan produk kecantikan yang aman dan efektif dengan menggunakan bahan-bahan alami.</li>
              <li>Meningkatkan kesejahteraan dan kepercayaan diri konsumen melalui produk berkualitas.</li>
              <li>Menerapkan praktik bisnis berkelanjutan yang ramah lingkungan.</li>
              <li>Membangun hubungan yang kuat dengan pelanggan, mitra bisnis, dan komunitas.</li>
            </ul>
          </p>
          <p>Produk Unggulan:
            <ul>
              <li>Royal Glow Skin Care Series - Rangkaian produk perawatan kulit yang diformulasikan untuk memberikan kulit yang sehat dan bercahaya.</li>
              <li>Elegant Matte Lipstick - Koleksi lipstik dengan warna-warna trendi dan formula tahan lama.</li>
              <li>Herbal Beauty Hair Care - Produk perawatan rambut yang terbuat dari bahan-bahan herbal untuk rambut yang kuat dan berkilau.</li>
              <li>Natural Essence Face Mask - Masker wajah dengan ekstrak alami untuk perawatan kulit mendalam.</li>
              <li>Youthful Radiance Serum - Serum anti-aging yang membantu mengurangi tanda-tanda penuaan.</li>
            </ul>
          </p>
          <p>Alamat Kantor Pusat: Jl. Raya Kebon Jeruk No. 123, Jakarta Barat, DKI Jakarta, Indonesia
          </p>
          <p>Kontak:
            <ul>
              <li>Telepon: (021) 555-6789</li>
              <li>Email: info@pesonaroyal.co.id</li>
              <li>Website: www.pesonaroyal.co.id</li>
            </ul>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection