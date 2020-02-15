<!-- ---------------------EMAIL-MODAL--------------------- -->
<div class="nomads-modal {{ session('emailSent') ? 'active' : '' }}" id="emailSent">
    <div class="overlay" data-close="true"></div>
    <div class="modal-box">
    
        <div class="ilustration" style="width: 130px;">
            <img src="{{ url('frontend/img/email-success.png')}}">
        </div>
    
        <h4 class="title mt-2">{{ session('emailSent') ? session('emailSent')['title'] : 'Email Sent!' }}</h4>
        <p class="message">{{ session('emailSent') ? session('emailSent')['message'] : 'Kindly check your inbox in order to verify the account.' }}</p>
    
        <button id="confirmation" class="nomads-btn py-2 px-5 mt-2" data-close="true" style="font-size: 16px;">Done</button>
        <br>
        
        <form id="requestEmail" method="post" action="{{ route('verification.resend') }}">
            @csrf
            <p class="mt-2">Doesn't receive an email? 
                <br> 
                <button class="btn btn-link m-0 p-0" type="submit">Request Again</button>
            </p>
        </form>
    </div>
</div>