@extends('layouts.app')

@section('title','Manajemen Lowongan | Baru')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Tambah Lowongan') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('job-management.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="event_id">Acara Terkait</label>
                  <select class="form-control @error('event_id') is-invalid @enderror" id="event_id" name="event_id" value="{{ old('event_id') }}" required>
                    @foreach($availableEvents as $event)
                      <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                  </select>
                  @error('event_id')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="position">Posisi</label>
                  <input type="text" class="form-control @error('position') is-invalid @enderror" name="position" id="position" placeholder="Posisi" autocomplete="off" value="{{ old('position') }}">
                  @error('position')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="description">Deskripsi lowongan</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" autocomplete="off" value="{{ old('description') }}" rows="6" maxlength="1000"></textarea>
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status') }}">
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
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
