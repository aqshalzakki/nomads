<div class="profile-card right">

    <div id="errors">
        
    </div>

    <div class="title mb-3">
        <h1>My Profile</h1>
        <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
    </div>

    <div id="message">
        @if(session()->has('message'))
            {{ session('message') }}
        @endif
    </div>

    <form id="profileForm" action="{{ route('profile.update', $user->profile->id) }}" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-4 col-md-11">
                <div class="user-profile-photo-card mb-5">
                    <label style="user-select: none;" class="photo m-0 user-select-none" for="selectPhoto" title="Pilih gambar...">
                        <img id="imageField" src="{{ $user->profile->image ? Storage::url($user->profile->image) : asset('frontend/images/profiles/default.jpg') }}">
                    </label>
                    <div class="select-photo mt-2">
                        <label style="user-select: none;" for="selectPhoto">Pilih Foto</label>
                        <input type="file" name="image" class="file-input" id="selectPhoto">
                    </div>
                    <ul class="rules mt-1">
                        <li>Besar file: maksimum 10.000.000 bytes (10 Megabytes)</li>
                        <li>Ekstensi file yang diperbolehkan: .JPG, .JPEG, .PNG</li>
                    </ul>
                    <span class="d-block mt-3" id="fileName"></span>
                </div>
        </div>
        <div class="col-lg-8">
            <div class="profile-form">
                    @csrf
                    @method('PATCH')

                    <h4>Ubah Data Diri</h4>
                    <div class="inputs">
                        <div class="input">
                            <label style="user-select: none;" for="nama">Name</label>
                            <input required type="text" name="name" id="nama" value="{{ old('name') ?? $user->name }}">
                        </div>
                        <div class="input">
                            <label style="user-select: none;" for="datePicker">
                                Tanggal Lahir
                            </label>
                                <input required
                                  autocomplete="0"
                                  type="date"
                                  class="datePicker @error('date_birth') is-invalid @enderror"
                                  id="datePicker"
                                  style="width: 100%;"
                                  value="{{ old('date_of_birth') ?? $user->profile->date_of_birth }}"
                                  name="date_of_birth"
                                />
                        </div>
                        <div class="input">
                            <label style="user-select: none;" for="jenis-kelamin">Jenis Kelamin</label>
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
                                    <label style="user-select: none;" class="radio-value" for="laki-laki">Laki-laki</label>
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
                                    <label style="user-select: none;" class="radio-value" for="perempuan">Perempuan</label>
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
                                    <label style="user-select: none;" class="radio-value" for="jenisLainnya">Lainnya</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4>Ubah Kontak</h4>
                    <div class="inputs">
                        <div class="input mb-4">
                            <label style="user-select: none;" for="email">Email</label>
                            <div class="relative">
                                <input
                                    required
                                    type="text"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') ?? $user->email }}"
                                />

                                @if(!$user->hasVerifiedEmail())
                                    <a id="verifyEmail" style="cursor: pointer;" class="verification">Klik disini untuk melakukan verifikasi Email anda.</a>
                                @endif
                            </div>
                            <span id="emailStatus" style="width: 20%;" class="status text-center">{{ $user->hasVerifiedEmail() ? 'Terverifikasi' : 'Tidak Terverifikasi' }}</span>
                        </div>
                        <div class="input">
                            <label style="user-select: none;" for="nomor-hp">Nomor HP</label>
                            <div class="relative">
                                <input
                                    required
                                    type="text"
                                    name="phone_number"
                                    id="nomor-hp"
                                    value="{{ old('phone_number') ?? $user->profile->phone_number }}"
                                />

                                @unless($user->profile->hasVerifiedPhoneNumber())
                                    <a class="verification" href="#" data-nmodal="#verifyPhone">
                                        Klik disini untuk melakukan verifikasi Nomor anda.
                                    </a>
                                @endunless
                            </div>
                            <span id="phoneStatus" style="width: 20%;" class="status text-center">{{ $user->profile->hasVerifiedPhoneNumber() ? 'Terverifikasi' : 'Tidak Terverifikasi'}}</span>
                        </div>
                    </div>

                    <button class="nomads-btn py-2" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>