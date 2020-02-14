<!-- ---------------------EMAIL-MODAL--------------------- -->
<div class="nomads-modal {{ (session('email') || session('verify') ) ? 'active' : '' }}" id="emailSent">
    <div class="overlay" data-close="true"></div>
    <div class="modal-box">
        <div class="ilustration" style="width: 130px;">
            <img src="{{ url('frontend/img/email-success.png')}}">
        </div>
        @if(session('email'))
	        <h4 class="title mt-2">{{ session('email.title') }}</h4>
	        <p class="message">{{ session('email.message') }}</p>
		@elseif(session('verify'))
    		<h4 class="title mt-2">{{ session('verify.title') }}</h4>
	        <p class="message">{{ session('verify.message') }}</p>
		@endif
        <button class="nomads-btn py-2 px-5 mt-2" data-close="true" style="font-size: 16px;">Done</button>
    </div>
</div>