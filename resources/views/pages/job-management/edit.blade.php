@extends('layouts.app')

@section('title','Manajemen Lowongan | Edit')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Lowongan') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('job-management.update', $job->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="event_id">Acara Terkait</label>
                  <select class="form-control @error('event_id') is-invalid @enderror" id="event_id" name="event_id" value="{{ $job->event_id }}" readonly>
                      <option value="{{ $job->event_id }}">{{ $job->event->name }}</option>
                  </select>
                  @error('event_id')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="position">Posisi</label>
                  <input type="text" class="form-control @error('position') is-invalid @enderror" name="position" id="position" placeholder="Posisi" autocomplete="off" value="{{ old('position') ?? $job->position }}">
                  @error('position')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="description">Deskripsi lowongan</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" autocomplete="off" rows="6" maxlength="1500">{{ old('description') ?? $job->description }}</textarea>
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status') ?? $job->status }}">
                        <option value="open" {{ $job->status == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="closed" {{ $job->status == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    @error('status')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('job-management.index') }}" class="btn btn-default">Kembali</a>
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
