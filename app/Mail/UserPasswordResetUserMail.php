<?php

namespace App\Mail;

use App\Models\PasswordReset;
use App\Models\User;

class UserPasswordResetUserMail extends BaseUserMail
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
        return $this->subject(trans('auth.reset_pwd'))
            ->view('mails.user-password-reset')
            ->text('mails.user-password-reset-plain');
    }
}
