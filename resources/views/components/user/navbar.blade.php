<!-- ---------------NAVBAR--------------- -->
<nav class="nomads-navbar">
    <div class="items-container">
        <div class="logo">
            <a href="/">
                <div class="logo-wrapper">
                    <img src="{{ url('frontend/img/logo_nomads.png')}}">
                </div>         
            </a>
        </div>	
        <div class="items-collapse">
            <label for="collapse" class="toggler">
                <span class="burger"></span>
            </label>
        </div>
        <input type="checkbox" id="collapse">
        <div class="menu-links">
            <ul> 
                <li class="{{ isActiveUrl('/') }}">
                    <a class="link" href="/">Home</a>
                </li>
                <li class="{{ isActiveUrl('travel-packages') }}">
                    <a class="link" href="{{ route('travel-packages.index') }}">Paket Travel</a>
                </li>
                <li>
                    <a class="link" href="#">Service</a>
                </li>
                <li>
                    <a class="link" href="#">Testimonial</a>
                </li>

                @auth
                    <li class="profile">
                        <div class="profile-wrapper">
                            <label class="profile-img" for="profileMenu">
                                <img src="{{ imageStoragePath( ($user->profile->image ?? 'profiles/default.jpg') ) }}">
                            </label>
                            <input type="checkbox" id="profileMenu">
                            <div class="profile-menu">
                                <ul>
                                    
                                    @if($user->isRole('USER'))
                                        
                                        <li class="{{-- isActiveUrl('profile') --}}">
                                            <a class="profile-menu-link" href="{{ route('profile.index') }}">My Account</a>
                                        </li>
                                        <li class="{{ isActiveUrl('transactions') }}">
                                            <a class="profile-menu-link" href="#">My Transaction</a>
                                        </li>

                                    @else
                                        
                                        <li class="{{ isActiveUrl('transactions') }}">
                                            <a class="profile-menu-link" href="{{ route('admin.index') }}">Dashboard</a>
                                        </li>

                                    @endif

                                    <li>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="profile-menu-link" type="submit">Log Out</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                @endif

                @guest
                    <a href="{{ route('login') }}" class="auth">
                        <span class="link">Login</span>
                    </a>
                @endguest
            </ul>
        </div>
    </div>
</nav>