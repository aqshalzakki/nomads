@extends('layouts.app')

@section('title', 'Profile')
@section('content')
    <!-- ----------------PROFILE-SECTION---------------- -->
    <section id="profile">
        <div class="container">
            <div class="nomads-breadcrumb my-4">
                <a href="#">My Profile</a>
                <span>/</span>
                <a href="#">Edit Profile</a>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 mb-4">
                    <!-- ---------Card-left--------- -->
                    <div class="profile-card left">
                        <div class="user">
                            <div class="left">
                                <div class="user-img">
                                    <img src="{{ imageStoragePath(auth()->user()->profile->image) }}" title="{{ auth()->user()->username }}">
                                </div>
                            </div>
                            <div class="right">
                                <h5 class="user-name">{{ auth()->user()->username }}</h5>
                                <a class="user-edit" href="#">
                                    <i class="fas fa-edit"></i>
                                    Edit Profile
                                </a>
                            </div>
                        </div>
                        <div class="menu">
                            <ul>
                                <li>
                                    <a class="menu-link" href="#">Ganti Password</a>
                                </li>
                                <li>
                                    <a class="menu-link" href="#">Passport</a>
                                </li>
                                <li>
                                    <a class="menu-link" href="#">Visa</a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu">
                            <div class="menu-name open-collapse-menu" data-collapsetrigger="#transaction">

                                <!-- ============MENING PAKE TAG a ATAU h3???============ -->
                                <!-- --------------PILIH-WEH-BAHHH!!-------------- -->
                                {{-- <a href="#">My Transaction</a> --}}
                                <h3>My Transactions</h3>

                                <!-- CLICK ME!!! -->
                                <i class="fas fa-angle-down"></i>

                            </div>
                            <ul id="transaction">
                                <li>
                                    <a class="menu-link" href="#">Menunggu Pembayaran</a>
                                </li>
                                <li>
                                    <a class="menu-link" href="#">Daftar Transaksi</a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu">
                            <div class="open-collapse-menu menu-name" data-collapsetrigger="#notification">

                                <!-- ============MENING PAKE TAG a ATAU h3???============ -->
                                <!-- --------------PILIH-WEH-BAHHH!!-------------- -->
                                {{-- <a href="#">Notification</a> --}}
                                <h3>Notifications</h3>

                                <!-- CLICK ME!!! -->   
                                <i class="fas fa-angle-down"></i>

                            </div>
                            <ul id="notification">
                                <li>
                                    <a class="menu-link" href="#">Ulasan</a>
                                </li>
                                <li>
                                    <a class="menu-link" href="#">Komplain Pemesanan</a>
                                </li>
                                <li>
                                    <a class="menu-link" href="#">Pesan Bantuan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu">
                            <div class="open-collapse-menu menu-name" data-collapsetrigger="#lainnya">

                                <!-- ============MENING PAKE TAG a ATAU h3???============ -->
                                <!-- --------------PILIH-WEH-BAHHH!!-------------- -->
                                {{-- <a href="#">Lainnya</a> --}}
                                <h3>Lainnya</h3>

                                <!-- CLICK ME!!! -->
                                <i class="fas fa-angle-down"></i>
                                

                            </div>
                            <ul id="lainnya">
                                <li>
                                    <a class="menu-link" href="#">Destinasi Favorit</a>
                                </li>
                                <li>
                                    <a class="menu-link" href="#">Saved Place</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
                        <form action="{{ route('profile.update', auth()->user()->profile->id) }}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-5 col-md-12">
                                <div class="user-profile-photo-card mb-5">
                                    <div class="photo">
                                        <img src="{{ imageStoragePath(auth()->user()->profile->image) }}">
                                    </div>
                                    <div class="select-photo mt-2">
                                        <label for="selectPhoto">Pilih Foto</label>
                                        <input type="file" name="image" id="selectPhoto">
                                    </div>
                                    <ul class="rules mt-1">
                                        <li>Besar file: maksimum 10.000.000 bytes (10 Megabytes)</li>
                                        <li>Ekstensi file yang diperbolehkan: .JPG, .JPEG, .PNG</li>
                                    </ul>
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
                                                <input required type="text" name="username" id="nama" value="{{ auth()->user()->username }}">
                                            </div>
                                            <div class="input">
                                                {{-- <label>Tanggal lahir</label> --}}
                                                {{-- <div class="selects">
                                                    <div class="select">
                                                        <select class="tanggal">
                                                            <option></option>    
                                                        </select>
                                                        <i class="fas fa-angle-down"></i>
                                                    </div>
                                                    <div class="select">
                                                        <select class="bulan">
                                                            <option>10</option>
                                                        </select>
                                                        <i class="fas fa-angle-down"></i>
                                                    </div>
                                                    <div class="select">
                                                        <select class="tahun">
                                                            <option>1999</option>
                                                        </select>
                                                        <i class="fas fa-angle-down"></i>
                                                    </div>
                                                </div> --}}
                                                <label for="datePicker">
                                                    Tanggal Lahir
                                                </label>
                                                    <input required
                                                      autocomplete="0" 
                                                      type="text"
                                                      class="datePicker @error('date_birth') is-invalid @enderror"
                                                      id="datePicker"
                                                      style="width: 70%;"
                                                      value="{{ auth()->user()->profile->date_of_birth }}"
                                                      name="date_of_birth" 
                                                    />
                                            </div>
                                            <div class="input">
                                                <label for="jenis-kelamin">Jenis Kelamin</label>
                                                <div class="radios">
                                                    <div class="radio">
                                                        <div class="wrapper">
                                                            <input
                                                                {{ auth()->user()->profile->isGender('Laki-laki') }}
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
                                                                {{ auth()->user()->profile->isGender('Perempuan') }} 
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
                                                                {{ auth()->user()->profile->isGender('Lainnya') }}
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
                                            <div class="input mb-3">
                                                <label for="Email">Email</label>
                                                <input required type="text" name="email" id="email" value="{{ auth()->user()->email }}">
                                                <span class="status">{{ auth()->user()->isVerified() }}</span>
                                            </div>
                                            <div class="input">
                                                <label for="nomor-hp">Nomor HP</label>
                                                <input required type="text" name="phone_number" id="nomor-hp" value="{{ auth()->user()->profile->phone_number }}">
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