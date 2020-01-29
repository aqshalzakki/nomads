@extends('layouts.auth')

@section('title', 'Login Page')

@section('content')
    <section id="login">  
      <div class="row m-0">
        
        <div class="col-lg-8 explore">
          <div class="explore-content">
            <h1 class="title">We Explore The New Life Much Better</h1>
            <div class="explore-images">
              <div class="img big">
                <img src="{{ url('frontend/images/login/explore4.png')}}">
              </div>
              <div class="img small">
                <img src="{{ url('frontend/images/login/explore2.png')}}">
              </div>
              <div class="img small">
                <img src="{{ url('frontend/images/login/explore1.png')}}">
              </div>
              <div class="img big">
                <img src="{{ url('frontend/images/login/explore3.png')}}">
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 login">
          <div class="login-card">
            <div class="logo">
                <a href="/">
                    <img src="{{ url('frontend/images/nomads_logo/logo_nomads.png') }}">
                </a>
            </div>
            <div class="form mt-4">
              <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="email">Email</label>
                  <input value="{{ old('email') }}" name="email" type="text" class="form-control" id="email">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input name="password" type="password" class="form-control" id="password">
                </div>
                <div class="checkbox">
                  <input type="checkbox" name="remember" id="remember">
                  <label for="remember">Remember me</label>
                </div>
                <button class="nomads-btn px-5 my-3 mx-auto d-block">Get Started</button>
              </form>
            </div>
            <div class="text-center">
              <a class="forgot-password" href="{{ route('password.request') }}">Forgot Your Password?</a>
            </div>

            <div class="text-center">
              <a class="forgot-password" href="{{ route('register') }}">Does'nt have an account?</a>
            </div>
          </div>
        </div>

      </div>
    </section>
@endsection