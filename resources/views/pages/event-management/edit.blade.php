@extends('layouts.app2')

@section('title','Manajemen Kegiatan | Edit')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Kegiatan') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('event-management.update', $event->id) }}" method="post" enctype="multipart/form-data">
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
                    <label for="image">Upload Gambar:</label>
                    <input class="form-control" type="file" id="image" name="image" accept=".png,.jpg,.jpeg">
                    <span class="file-size-indicator">Max: 2MB</span>
                    @error('image')
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
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="6" maxlength="1000">{{ old('description') ?? $event->description }}</textarea>
                  <!--<small class="form-text text-muted">Maximum x karakter</small>-->
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="row">
                  <div class="form-group col-md-4">
                      <label for="event_type">Jenis Acara</label>
                      <select class="form-control @error('event_type') is-invalid @enderror" id="event_type" name="event_type" value="{{ old('event_type') ?? $event->event_type }}">
                          <option value="Job Fair"  {{ $event->event_type == 'Job Fair' ? 'selected' : '' }}>Job Fair</option>
                          <option value="Campus Hiring" {{ $event->event_type == 'Campus Hiring' ? 'selected' : '' }}>Campus Hiring</option>
                      </select>
                      @error('event_type')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>

                  <div class="form-group col-md-4">
                      <label for="start_date">Tanggal Mulai</label>
                      <input class="form-control @error('start_date') is-invalid @enderror" type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') ?? $event->start_date }}">
                      @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>

                  <div class="form-group col-md-4">
                      <label for="end_date">Tanggal Akhir</label>
                      <input class="form-control @error('end_date') is-invalid @enderror" type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date')  ?? $event->end_date }}">
                      @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                      <label for="status">Status</label>
                      <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                          <option value="open" {{ $event->status == 'open' ? 'selected' : '' }}>Open</option>
                          <option value="closed" {{ $event->status == 'closed' ? 'selected' : '' }}>Closed</option>
                      </select>
                      @error('status')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="companies">Anggota Kegiatan:</label>
                      <select multiple size="6" class="form-select form-control @error('status') is-invalid @enderror" id="companies" name="companies[]">
                        @foreach($companies as $company)
                          <option value="{{ $company->id }}" @if(in_array($company->id, $event->companies->pluck('id')->toArray())) selected @endif>{{ $company->user->name }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('event-management.index') }}" class="btn btn-default">Kembali</a>

            </form>
        </div>
    </div>
    <script>
        $('#description').summernote({
            placeholder: 'Desripsikan kegiatan',
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
    <script>
        // Date validation
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        startDate.setAttribute('min', today);

        startDate.addEventListener('change', function() {
            endDate.setAttribute('min', this.value);
            validateDates();
        });

        endDate.addEventListener('change', validateDates);

        function validateDates() {
            if (startDate.value && endDate.value) {
                if (new Date(endDate.value) < new Date(startDate.value)) {
                    endDate.setCustomValidity('Tanggal akhir harus setelah tanggal mulai');
                } else {
                    endDate.setCustomValidity('');
                }
            }
        }

        /* Character counter for description
            const description = document.getElementById('description');
            description.addEventListener('input', function() {
                const remaining = 1000 - this.value.length;
                const small = this.nextElementSibling;
                small.textContent = `${remaining} characters remaining`;
                if (remaining < 100) {
                    small.classList.add('text-warning');
                } else {
                    small.classList.remove('text-warning');
                }
            });*/
});
    </script>
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
