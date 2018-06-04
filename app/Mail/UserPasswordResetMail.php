<?php

namespace App\Mail;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $password_reset;

    /**
     * UserRegisterMail constructor.
     * @param User $user
     * @param PasswordReset $password_reset
     */
    public function __construct(User $user, PasswordReset $password_reset)
    {
        $this->user = $user;
        $this->password_reset = $password_reset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('company.no-reply'))
            ->subject(trans('auth.reset_pwd'))
            ->view('mails.user-password-reset')
            ->text('mails.user-password-reset-plain');
    }
}
