<div class="form mt-4">
  <form action="{{ route('register') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="username">Username</label>
      <input value="{{ old('username') }}" required name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input value="{{ old('email') }}" required name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input required name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
    </div>
    <div class="form-group">
      <label for="password_confirmation">Password Confirmation</label>
      <input required name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
    </div>
    <button class="nomads-btn px-5 my-3 mx-auto d-block">Register</button>
  </form>
</div>
<div class="text-center">
  <a class="forgot-password" href="{{ route('login') }}" data-authtype="login">Already have an account?</a>
</div>