@extends('layouts.app')

@section('title','Dasbor')
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
    <div class="row">
        <!-- Statistik Pengguna -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pelamar Terdaftar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
            </div>
            </div>
        </div>

        <!-- Statistik Perusahaan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Perusahaan Terdaftar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['companies'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Event yang Tersedia -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Event Job Fair Tersedia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">20</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Jelajahi Job Fair -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('landing') }}">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jelajahi Job Fair</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-search fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>

    <!-- Table Job Fair Events -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Event Job Fair</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Event</th>
                            <th>Perusahaan yang Ikut</th>
                            <th>Lowongan</th>
                            <th>Lamaran Masuk</th>
                            <th>Pending</th>
                            <th>Ditolak</th>
                            <th>Diterima</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Job Fair Januari</td>
                            <td>50</td>
                            <td>200</td>
                            <td>1,500</td>
                            <td>300</td>
                            <td>200</td>
                            <td>1,000</td>
                            <td><a href="#" class="btn btn-primary btn-sm">Lihat Detail</a></td>
                        </tr>
                        <tr>
                            <td>Job Fair Februari</td>
                            <td>45</td>
                            <td>180</td>
                            <td>1,300</td>
                            <td>250</td>
                            <td>150</td>
                            <td>900</td>
                            <td><a href="#" class="btn btn-primary btn-sm">Lihat Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
@endsection


    <!-- Halo Pengguna -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold .text-primary-emphasis text-uppercase mb-1">{{ __('Halo, ') }}{{ $user->fullname }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-smile fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    <!-- Chart Area -->
    <!-- <div class="row">
        <!-- Applications Bar Chart -->
        <!-- <div class="col-lg-6">
            <canvas id="applicationsChart"></canvas>
        </div> -->

        <!-- Status Pie Chart -->
        <!-- <div class="col-lg-6">
            <canvas id="statusPieChart"></canvas>
        </div> -->

        <!-- Line Chart -->
        <!-- <div class="col-lg-12">
            <canvas id="lineChart"></canvas>
        </div> -->
    <!-- </div> -->
