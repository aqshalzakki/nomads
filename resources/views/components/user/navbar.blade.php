<!-- ---------------NAVBAR--------------- -->
<nav class="nomads-navbar">
    <div class="items-container">
        <div class="logo">
            <a href="#">
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
                <li class="active">
                    <a class="link" href="/">Home</a>
                </li>
                <li>
                    <a class="link" href="#">Paket Travel</a>
                </li>
                <li>
                    <a class="link" href="#">Service</a>
                </li>
                <li>
                    <a class="link" href="#">Testimonial</a>
                </li>

                @auth
                    <a href="{{ route('profile.index') }}" class="auth">
                        <span class="link">Profile</span>
                    </a>
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