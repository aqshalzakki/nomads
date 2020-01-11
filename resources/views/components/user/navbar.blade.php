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
                    <a class="link" href="#">Paket Travel</a>
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
                                <img src="{{ imageStoragePath( (auth()->user()->profile->image ?? 'profiles/default.jpg') ) }}">
                            </label>
                            <input type="checkbox" id="profileMenu">
                            <div class="profile-menu">
                                <ul>
                                    
                                    @if(auth()->user()->isUser())
                                        
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
                                        {{-- <form method="post" class="d-inline" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="btn btn-link profile-menu-link" type="submit">
                                               Log Out 
                                            </button>
                                        </form> --}}
                                        <a class="profile-menu-link" href="{{ route('logout') }}">Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="auth">
                        <span class="link">Login</span>
                    </a>
                @endguest
            </ul>
        </div>
    </div>
</nav>