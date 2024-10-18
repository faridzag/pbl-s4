@extends('layouts.app2')

@section('title','Profil')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profil') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card shadow mb-4">
                <div class="card-profile-image mt-4">
                    @if (isset(Auth::user()->avatar))
                        <img src="{{ asset(str_replace('public/', '', 'storage/' . Auth::user()->avatar)) }}" alt="{{ Auth::user()->name }}"width="180" height="180" class="rounded-circle shadow-4-strong">
                    @else
                        <figure class="rounded-circle avatar avatar font-weight-bold" style="font-size: 60px; height: 180px; width: 180px;" data-initial="{{ Auth::user()->username[0] }}">
                        </figure>
                    @endif
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{  Auth::user()->name }}</h5>
                                <p>{{ Auth::user()->username }} / {{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            @if (isset($applicant->cv_path))
                                <a href="{{ Storage::url($applicant->cv_path) }}" target="_blank">Lihat CV</a>
                            @else
                                <span class="text-muted">Anda belum mengupload CV</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Info Akun</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('applicant-profile.update') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <h6 class="heading-small text-muted mb-4">Data Diri</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Nama</label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ old('name', Auth::user()->name) }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="username">Nama Pengguna</label>
                                        <input type="text" id="username" class="form-control" name="username" placeholder="Name" value="{{ old('username', Auth::user()->username) }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="phone_number">Nomor HP</label>
                                        <input type="tel" id="phone_number" class="form-control" value="{{ old('phone_number', Auth::user()->applicant->phone_number)}}" id="phone_number" name="phone_number" placeholder="No telepon" minlength="10" maxlength="13" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Alamat Email<span class="small text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="description">Profil diri<span class="small text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="description" autocomplete="off" rows="6" maxlength="1500">{{ old('description') ?? Auth::user()->applicant->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="avatar" class="form-control-label">Upload Foto Profil:</label>
                                        <input class="form-control" type="file" id="avatar" name="avatar" accept=".png,.jpg,.jpeg">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="cv_path" class="form-control-label">Upload CV (pdf):</label>
                                        <input class="form-control" type="file" id="cv_path" name="cv_path" accept=".pdf">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Password Lama</label>
                                        <input type="password" id="current_password" class="form-control" name="current_password" placeholder="Password Lama" minlength="8" maxlength="16">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">Password Baru</label>
                                        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="Password Baru" minlength="8" maxlength="16">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Konfirmasi Password</label>
                                        <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" minlength="8" maxlength="16">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
