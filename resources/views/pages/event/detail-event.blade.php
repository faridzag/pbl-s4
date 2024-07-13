@extends('layouts.main')

@section('title', 'Detail Event')

@section('content')
<div class="py-5" style="background-color: #D3E1E9;">
    <div class="container">
        <div class="row align-items-center text-center text-md-start">
            <div class="col-md-4 mb-3 mb-md-0">
                @if($event->image)
                    <img src="{{ asset(str_replace('public/', '', 'storage/' . $event->image)) }}" class="img-fluid mx-auto mx-md-0" alt="{{ $event->name }}">
                @else
                    <img src="{{asset('img/campus-hiring.jpg')}}" class="img-fluid mx-auto mx-md-0" alt="Event Image">
                @endif
            </div>
            <div class="col-md-8 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                <div class="text-container text-center text-md-start">
                    <h1 class="h2 font-weight-bold">{{ $event->name }}</h1>
                    <ul class="list-group bg-transparent">
                        <li class="list-group-item bg-transparent">
                            <i class="fas fa-map-marker-alt"></i><span>{{ $event->location }}</span>
                        </li>
                        <li class="list-group-item bg-transparent">
                        <i class="fas fa-calendar-alt"></i><span>{{ \Carbon\Carbon::parse($event->start_date)->format('d-M-Y') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d-M-Y') }}<span>
                        </li>
                    </ul>
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
                <h2 class="font-weight-bold mb-4">Tentang {{ $event->name }}</h2>
                <p  style="text-align: justify;">{!! $event->description !!}</p>
                <h2 class="font-weight-bold mb-4">List Lowongan</h2>
                @if ($companies->count() > 0)
                    <ul class="list-group">
                        @foreach ($companies as $company)
                            <li class="list-group-item">
                                <h5 class="font-weight-bold">{{ $company->user->name }}</h5>
                                @if ($company->vacancies->count() > 0)
                                    <ul class="list-group list-group-flush">
                                        @foreach ($company->vacancies->where('status', 'open') as $vacancy)
                                            @if ($vacancy->event_id === $event->id)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div style="display: inline-block; vertical-align: middle;">
                                                        <h6 class="text-primary font-weight-bold">{{ $vacancy->position }}</h6>
                                                        <p class="text-secondary" style="text-align: left;">{{ Str::limit($vacancy->description, 50) }}...</p>  </div>
                                                    <a href="{{ route('vacancy.show', $vacancy->id) }}" class="text-dark">Selengkapnya</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Perusahaan ini belum membuat lowongan.</p>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    {{ $companies->links() }}
                @else
                    <p>Tidak ada perusahaan yang terdaftar di event ini.</p>
                @endif
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <h2 class="text-center font-weight-bold mb-4">List Perusahaan Terdaftar</h2>
                    @if ($companies->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach ($companies as $company)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div style="display: inline-block; vertical-align: middle;">
                                        <div style="display: inline-block;">
                                            <h6 class="font-weight-bold">{{ $company->user->name }}</h6>
                                            <p class="text-warning" style="text-align: left;">
                                                <?php $jobCount = $company->vacancies()->where('event_id', $event->id)->where('status', 'open')->count(); ?>
                                                {{ $jobCount }} Lowongan
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ route('company.profile', $company->id) }}" class="text-dark">Selengkapnya</a>
                                </li>
                            @endforeach
                        </ul>

                        {{ $companies->links() }}
                    @else
                        <p>Belum ada perusahaan yang terdaftar di event ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
