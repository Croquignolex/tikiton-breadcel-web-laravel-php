<?php

namespace App\Mail;

use App\Models\User;

class UserRegisterMail extends BaseMail
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
        return $this->from(config('company.no-reply'))
            ->subject(trans('auth.sign_up'))
            ->view('mails.user-register')
            ->text('mails.user-register-plain');
    }
}
