<?php

namespace App\Mail;

use App\Models\User;

class UserEmailChangeMail extends BaseUserMail
{
    /**
     * UserEmailChangeMail constructor.
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
        return $this->subject(trans('auth.change_email'))
            ->view('mails.user-email-change')
            ->text('mails.user-email-change-plain');
    }
}