@extends('layouts.app')

@section('title', 'Profile')
@section('content')
    <!-- ----------------PROFILE-SECTION---------------- -->
    <section class="custom-bg" id="profile">
        <div class="container">
            <div class="nomads-breadcrumb my-4">
                <a href="{{ route('profile.index') }}">My Profile</a>
                <span>/</span>
                <a href="{{ route('profile.index') }}">Edit Profile</a>
            </div>
            <div class="row">

                {{-- include card left / sidebar --}}
                    @include('components.user.profile.sidebar', compact('user'))
                {{-- ------------- --}}

                <div class="col-lg-9 col-md-8">
                    <!-- ---------Card-Right--------- -->
                    <div class="profile-card right">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="title mb-3">
                            <h1>Profil Saya</h1>
                            <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
                        </div>
                        <form action="{{ route('profile.update', $user->profile->id) }}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-5 col-md-12">
                                <div class="user-profile-photo-card mb-5">
                                    <div class="photo">
                                        <img id="imageField" src="{{ imageStoragePath($user->profile->image) }}">
                                    </div>
                                    <div class="select-photo mt-2">
                                        <label for="selectPhoto">Pilih Foto</label>
                                        <input type="file" name="image" class="file-input" id="selectPhoto">
                                    </div>
                                    <ul class="rules mt-1">
                                        <li>Besar file: maksimum 10.000.000 bytes (10 Megabytes)</li>
                                        <li>Ekstensi file yang diperbolehkan: .JPG, .JPEG, .PNG</li>
                                    </ul>
                                    <span class="d-block mt-3" id="fileName"></span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="profile-form">
                                        @csrf
                                        @method('PATCH')

                                        <h4>Ubah Data Diri</h4>
                                        <div class="inputs">
                                            <div class="input">
                                                <label for="nama">Username</label>
                                                <input required type="text" name="username" id="nama" value="{{ old('username') ?? $user->username }}">
                                            </div>
                                            <div class="input">
                                                <label for="datePicker">
                                                    Tanggal Lahir
                                                </label>
                                                    <input required
                                                      autocomplete="0"
                                                      type="text"
                                                      class="datePicker @error('date_birth') is-invalid @enderror"
                                                      id="datePicker"
                                                      style="width: 70%;"
                                                      value="{{ old('date_of_birth') ?? $user->profile->date_of_birth }}"
                                                      name="date_of_birth"
                                                    />
                                            </div>
                                            <div class="input">
                                                <label for="jenis-kelamin">Jenis Kelamin</label>
                                                <div class="radios">
                                                    <div class="radio">
                                                        <div class="wrapper">
                                                            <input
                                                                {{ $user->profile->isGender('Laki-laki') }}
                                                                type="radio"
                                                                name="gender"
                                                                value="Laki-laki"
                                                                id="laki-laki"
                                                            />
                                                            <span class="custom-radio"></span>
                                                        </div>
                                                        <label class="radio-value" for="laki-laki">Laki-laki</label>
                                                    </div>
                                                    <div class="radio">
                                                        <div class="wrapper">
                                                            <input
                                                                {{ $user->profile->isGender('Perempuan') }}
                                                                type="radio"
                                                                name="gender"
                                                                value="Perempuan"
                                                                id="perempuan"
                                                            />
                                                            <span class="custom-radio"></span>
                                                        </div>
                                                        <label class="radio-value" for="perempuan">Perempuan</label>
                                                    </div>
                                                    <div class="radio">
                                                        <div class="wrapper">
                                                            <input
                                                                {{ $user->profile->isGender('Lainnya') }}
                                                                type="radio"
                                                                name="gender"
                                                                value="Lainnya"
                                                                id="jenisLainnya"
                                                            />
                                                            <span class="custom-radio"></span>
                                                        </div>
                                                        <label class="radio-value" for="jenisLainnya">Lainnya</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h4>Ubah Kontak</h4>
                                        <div class="inputs">
                                            <div class="input mb-4">
                                                <label for="email">Email</label>
                                                <div class="relative">
                                                    <input
                                                        required
                                                        type="text"
                                                        name="email"
                                                        id="email"
                                                        value="{{ old('email') ?? $user->email }}"
                                                    />

                                                @if(!$user->hasVerifiedEmail())
                                                    <a class="verification" href="{{ url('/email/verify') }}">Klik disini untuk melakukan verifikasi Email anda.</a>
                                                @endif
                                                </div>
                                                <span class="status">{{ $user->hasVerifiedEmail() ? 'Terverifikasi' : 'Not Verified' }}</span>
                                            </div>
                                            <div class="input">
                                                <label for="nomor-hp">Nomor HP</label>
                                                <div class="relative">
                                                    <input
                                                        type="text"
                                                        name="phone_number"
                                                        id="nomor-hp"
                                                        value="{{ old('phone_number') ?? $user->profile->phone_number }}"
                                                    />

                                                    <a class="verification" href="#">Klik disini untuk melakukan verifikasi Nomor anda.</a>
                                                </div>
                                                <span class="status">Terverifikasi</span>
                                            </div>
                                        </div>

                                        <button class="nomads-btn py-2" type="submit">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-script')

  <script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js')}}"></script>
    <script>
      $(document).ready(function(){
        $('#datePicker').datepicker({
              format: 'yyyy-mm-dd',
              uiLibrary: 'bootstrap4',
              icons: {
                rightIcon: '<img src="{{ url('frontend/images/ic_doe.png')}}" alt="" />'
              }
            });
      })
    </script>

@endpush
