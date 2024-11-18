@extends('layouts.app2')

@section('title','Manajemen Lowongan | Baru')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Tambah Lowongan') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('job-management.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
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
                    <div class="form-group col-md-4">
                        <label for="position">Posisi</label>
                        <input type="text" class="form-control @error('position') is-invalid @enderror" name="position" id="position" placeholder="Posisi" autocomplete="off" value="{{ old('position') }}">
                        @error('position')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status') }}">
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                </div>

                <div class="form-group">
                  <label for="description">Deskripsi lowongan</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" autocomplete="off" rows="6" maxlength="1500">{{ old('description') }}</textarea>
                  @error('description')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="accept_message">Pesan diterima</label>
                  <textarea class="form-control @error('accept_message') is-invalid @enderror" name="accept_message" id="accept_message" autocomplete="off" rows="6" maxlength="1500">{{ old('accept_message') }}</textarea>
                  <span class="text-secondary">Informasi yang mau dikirimkan untuk pelamar yang diterima nantinya</span>
                  @error('accept_message')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="reject_message">Pesan ditolak</label>
                  <textarea class="form-control @error('reject_message') is-invalid @enderror" name="reject_message" id="reject_message" autocomplete="off" rows="6" maxlength="1500">{{ old('reject_message') }}</textarea>
                  <span class="text-secondary">Informasi yang mau dikirimkan untuk pelamar yang ditolak nantinya</span>
                  @error('reject_message')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('job-management.index') }}" class="btn btn-default">Kembali</a>

            </form>
        </div>
    </div>
    <script>
        $('#description').summernote({
            placeholder: 'Deskripsi lowongan',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['help']]
            ]
        });
        $('#accept_message').summernote({
            placeholder: 'Pesan Diterima',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['help']]
            ]
        });
        $('#reject_message').summernote({
            placeholder: 'Pesan Ditolak',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['help']]
            ]
        });
    </script>


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
