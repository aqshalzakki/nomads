<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Config;

class EmailVerification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user,
           $oldEmail,
           $urlVerification;

    public function __construct($user, $oldEmail = null)
    {
        $this->user = $user;
        $this->oldEmail = $oldEmail;

        $this->urlVerification = $this->getUrlVerification(); 
        session('verify', [
            'title'   => 'Success!',
            'message' => 'Email Successfully Verified.'
        ]);
    }

    public function getUrlVerification()
    {
        return url()->temporarySignedRoute(
            'verification.verify',
                now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $this->user->getKey(),
                'hash' => sha1($this->user->getEmailForVerification()),
            ]
        );
    }

    public function build()
    {
        return $this->markdown('email.update-email');
    }
}
