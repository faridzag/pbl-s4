@extends('layout.app')

@section('title', 'Buat Acara')

@section('content')
<form action="{{isset($event) ? route('event.tambah.update', $event->id) : route('event.tambah.simpan')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{isset ($event) ? 'Edit Detail Acara' : 'Buat Acara Baru'}}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Acara</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{isset($event) ? $event->name : ''}}">
                    </div>

                    <div class="form-group">
                        <label for="event_type">Jenis Acara</label>
                        <select class="form-control" id="event_type" name="event_type" value="{{isset($event) ? $event->event_type : ''}}">
                            <option value="Job Fair">Job Fair</option>
                            <option value="Direct Applicant">Direct Applicant</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{isset($event) ? $event->date : ''}}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection