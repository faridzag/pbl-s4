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
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold .text-primary-emphasis text-uppercase mb-1">{{ __('Halo, ') }}{{ $user->name }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-smile fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Earnings (Monthly) Card Example -->
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
@endsection
