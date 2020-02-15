<div class="profile-card right">
    <div class="title mb-3">
        <h1>Change Password</h1>
        <p>Manage your password by changing it, enter the password that corresponds to your Nomads account.</p>
    </div>
    <div class="change-password-form row">
        <div class="col-lg-8">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session()->has('message'))
            <div class="alert alert-primary">
                {{ session('message') }}
            </div>
        @endif
            <form class="px-4" action="{{ route('profile.password.update', $user->id) }}" method="POST" data-urlcheckpassword="{{ route('profile.password.check') }}">
                
                @csrf
                @method('patch')

                <div class="password-input mb-2">
                    <label for="currentPassword">Your current password</label>
                    <div class="icon-group d-flex">
                        <input required type="password" name="current_password" id="currentPassword" value="{{ old('current_password') }}">
                        <button type="button" data-passwordtarget="#currentPassword">
                            <i class="fas fa-fw fa-eye-slash"></i>
                        </button>
                    </div>
                    <div id="error"></div>
                    <a href="#">Forgot password?</a>
                </div>
                <div class="password-input mb-2">
                    <label for="newPassword">Enter new password</label>
                    <div class="icon-group d-flex">
                        <input required type="password" name="new_password" id="newPassword">
                        <button type="button" data-passwordtarget="#newPassword">
                            <i class="fas fa-fw fa-eye-slash"></i>
                        </button>
                    </div>
                    <small>6 characters minimum</small>
                </div>
                <div class="password-input mb-2">
                    <label for="repeatPassword">Repeat new password</label>
                    <div class="icon-group d-flex">
                        <input required type="password" name="new_password_confirmation" id="repeatPassword">
                        <button type="button" data-passwordtarget="#repeatPassword">
                            <i class="fas fa-fw fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <button class="d-block nomads-btn px-5 ml-auto mt-3 disabled" id="btnChangePass">Save</button>
            </form>    
        </div>
    </div>
</div>