<?php

namespace App\Mail;

use App\Models\User;

class UserRegisterUserMail extends BaseUserMail
{
    /**
     * UserRegisterMail constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('auth.sign_up'))
            ->view('mails.user-register')
            ->text('mails.user-register-plain');
    }
}
