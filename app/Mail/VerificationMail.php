<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $verificationCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $verificationCode)
    {
        $this->user = $user;
        $this->verificationCode = $verificationCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('verfication')
                    ->with([
                        'user' => $this->user,
                        'verificationCode' => $this->verificationCode
                    ]);
    }
}
