<?php

namespace App\Mail;

use App\Models\User;
use App\Models\PasswordReset;

class UserPasswordResetMail extends BaseUserMail
{
    public $reset_link;

    /**
     * UserRegisterMail constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->reset_link = PasswordReset::where('email', $user->email)
            ->first()->reset_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('auth.reset_your_pwd'))
            ->view('mails.user-password-reset')
            ->text('mails.user-password-reset-plain');
    }
}
