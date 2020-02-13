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
        <div class="col-lg-4 col-md-11">
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
        <div class="col-lg-8">
            <div class="profile-form">
                    @csrf
                    @method('PATCH')

                    <h4>Ubah Data Diri</h4>
                    <div class="inputs">
                        <div class="input">
                            <label for="name">Name</label>
                            <input required type="text" name="name" id="name" value="{{ old('name') ?? $user->name }}">
                        </div>
                        <div class="input">
                            <label for="datePicker">
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
                            <span style="width: 20%;" class="status text-center">{{ $user->hasVerifiedEmail() ? 'Terverifikasi' : 'Not Verified' }}</span>
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
                            <span style="width: 20%;" class="status text-center">{{ $user->profile->hasVerifiedPhoneNumber() ? 'Terverifikasi' : 'Tidak Terverifikasi' }}</span>
                        </div>
                    </div>

                    <button class="nomads-btn py-2" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>