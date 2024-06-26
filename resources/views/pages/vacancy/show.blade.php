@extends('layouts.main')

@section('title', 'Job Vacancy Detail')

@section('content')
<div class="container mt-5">
    <div class="row">
    <div class="col-md-8">
    <h1>{{ $vacancy->position }}</h1>
    <p><b>Perusahaan:</b> {{ $vacancy->company->user->fullname }}</p>
    <hr>
    <div class="mb-3">
        <h2>Deskripsi Lowongan</h2>
        <p>{!! $vacancy->description !!}</p>
    </div>

    @auth
        @if (Auth::user()->role === 'APPLICANT')  
        @if (!$applicant->applications()->where('vacancy_id', $vacancy->id)->exists())  
        <form method="POST" action="{{ route('apply.job') }}">
                    @csrf
                    <input type="hidden" name="vacancy_id" value="{{ $vacancy->id }}">
                    <input type="hidden" name="company_id" value="{{ $vacancy->company->id }}">
                    <input type="hidden" name="event_id" value="{{ $vacancy->event->id }}">
                    <button type="submit" class="btn btn-primary">Apply</button>
                </form>
            @else
                <p>Anda sudah melamar untuk lowongan ini.</p>
            @endif
        @else
            <p>Anda tidak dapat melamar karena bukan pelamar.</p>
        @endif
    @else
        <p>Silahkan Login untuk melamar.</p>
    @endauth
</div>

        <div class="col-md-4">
            <h3>Lowongan Serupa di {{ $company->user->fullname }}</h3>
            @if ($similarVacancies->count() > 0)
                <ul class="list-group">
                    @foreach ($similarVacancies as $similarVacancy)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('vacancy.show', $similarVacancy->id) }}">{{ $similarVacancy->position }}</a>
                            <span class="badge badge-primary badge-pill">Lihat Detail</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Tidak ada lowongan serupa saat ini.</p>
            @endif
        </div>
    </div>
</div>
@endsection