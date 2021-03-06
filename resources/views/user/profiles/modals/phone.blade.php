<!-- ---------------------VERIFY-PHONE-MODAL--------------------- -->
<div class="nomads-modal" id="verifyPhone">
    <div class="overlay" data-close="true"></div>
    <div class="modal-box">
        <div class="close-modal" data-close="true">&times;</div>
        <div class="ilustration">
            <img src="{{ url('frontend/img/verify-phone.png')}}">
        </div>
        <h4 class="title mt-2">Verify Your Phone Number</h4>
        <p class="message">Please type the magic number we've sent to +{{ $user->profile->phone_number }}</p>
        <form class="verify-phone" action="{{ route('profile.token', $user->id) }}" method="post">
            @csrf
            @method('put')
            <div class="magic-number-inputs" id="magicNumberInputs">
                @for($i = 1; $i <= 4; $i++)
                    <input type="number" required name="digits[]">
                @endfor
            </div>
            @error('token') <small class="verify-error mt-2">{{ $message }}</small> @enderror
            
            <button class="nomads-btn py-2 px-5 mt-3" type="submit" style="font-size: 16px;">Verify</button>
        </form>
    </div>
</div>