<div class="col-lg-3 col-md-4 mb-4">
    <!-- ---------Card-left--------- -->
    <div class="profile-card left">
        <div class="user">
            <div class="left">
                <div class="user-img">
                    <a href="{{ route('profile.index') }}">
                        <img src="{{ imageStoragePath($user->profile->image) }}" title="{{ $user->username }}">
                    </a>
                </div>
            </div>
            <div class="right">
                {{-- <a href="{{ route('profile.index') }}">  --}}
                    <h5 class="user-name">
                        {{ $user->username }}
                    </h5>
                {{-- </a> --}}
                <a class="user-edit" href="{{ route('profile.index') }}">
                    <i class="fas fa-edit"></i>
                    Edit Profile
                </a>
            </div>
        </div>
        <div class="menu">
            <ul>
                <li class="{{ isActiveUrl('profile/password') ? 'menu-active' : '' }}">
                    <a class="menu-link" href="{{ route('profile.password.edit') }}">Ganti Password</a>
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
                <h3>My Transactions</h3>
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
                <h3>Notifications</h3>   
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
                <h3>Lainnya</h3>
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