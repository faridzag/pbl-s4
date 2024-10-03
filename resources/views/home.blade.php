@extends('layouts.app')

@section('title', 'Dashboard')
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

    @if($role === 'JPC')
        <div class="row">
            <!-- Registered Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pengguna Terdaftar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registered Applicants -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pelamar Terdaftar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['applicants'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registered Companies -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Perusahaan Terdaftar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['companies'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-building fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Events -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Kegiatan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['events'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Events List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Tipe</th>
                                <th>Status</th>
                                <th>Tanggal Mulai</th>
                                <th>End Date</th>
                                <th>Total Perusahaan</th>
                                <th>Total Lowongan</th>
                                <th>Total Lamaran</th>
                                <th>Pending</th>
                                <th>Rejected</th>
                                <th>Accepted</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{ $event['name'] }}</td>
                                <td>{{ $event['event_type'] }}</td>
                                <td>{{ ucfirst($event['status']) }}</td>
                                <td>{{ $event['start_date'] }}</td>
                                <td>{{ $event['end_date'] ?? 'N/A' }}</td>
                                <td>{{ $event['companies_count'] }}</td>
                                <td>{{ $event['jobs_count'] }}</td>
                                <td>{{ $event['applications_count'] }}</td>
                                <td>{{ $event['pending_count'] }}</td>
                                <td>{{ $event['reject_count'] }}</td>
                                <td>{{ $event['accept_count'] }}</td>
                                <td><a href="#" class="btn btn-primary btn-sm">Lihat Detail</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info" role="alert">
            Selamat datang. {{ $user->name }} {{ $role }}
        </div>
    @endif

@endsection
