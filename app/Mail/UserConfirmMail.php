<?php

namespace App\Mail;

use App\Models\User;

class UserConfirmMail extends BaseMail
{
    /**
     * UserConfirmMail constructor.
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
        return $this->from($this->user)
            ->subject('Nouveau client')
            ->view('mails.user-confirm')
            ->text('mails.user-confirm-plain');
    }
}
