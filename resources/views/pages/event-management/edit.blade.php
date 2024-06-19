@extends('layouts.app')

@section('title','Manajemen Kegiatan | Edit')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Kegiatan') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('event-management.update', $event->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="name">Nama Kegiatan</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Kegiatan" autocomplete="off" value="{{ old('name') ?? $event->name }}">
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="location">Lokasi</label>
                  <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" id="location" placeholder="Lokasi" autocomplete="off" value="{{ old('location') ?? $event->location }}">
                  @error('location')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="description">Deskripsi kegiatan</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" autocomplete="off" rows="6" maxlength="1000">{{ old('description') ?? $event->description }}</textarea>
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="event_type">Jenis Acara</label>
                    <select class="form-control @error('event_type') is-invalid @enderror" id="event_type" name="event_type" value="{{ old('event_type') ?? $event->event_type }}">
                        <option value="Job Fair"  {{ $event->event_type == 'Job Fair' ? 'selected' : '' }}>Job Fair</option>
                        <option value="Campus Hiring" {{ $event->event_type == 'Campus Hiring' ? 'selected' : '' }}>Campus Hiring</option>
                    </select>
                    @error('event_type')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="start_date">Tanggal Mulai</label>
                    <input class="form-control @error('start_date') is-invalid @enderror" type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') ?? $event->start_date}}">
                    @error('start_date')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="open" {{ $event->status == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="closed" {{ $event->status == 'closed' ? 'selected' : '' }}>Closed</option>
                        <option value="ongoing" {{ $event->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="done" {{ $event->status == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                    @error('status')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="companies">Anggota Kegiatan:</label>
                    <select multiple size="3" class="form-select form-control @error('status') is-invalid @enderror" id="companies" name="companies[]">
                      @foreach($companies as $company)
                        <option value="{{ $company->id }}" @if(in_array($company->id, $event->companies->pluck('id')->toArray())) selected @endif>{{ $company->user->fullname }}</option>
                      @endforeach
                  </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('event-management.index') }}" class="btn btn-default">Kembali</a>

            </form>
        </div>
    </div>

    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
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
@endpush
