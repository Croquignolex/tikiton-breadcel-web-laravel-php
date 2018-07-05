<?php

namespace App\Mail;

use App\Models\User;

class UserOrderMail extends BaseMail
{
    /**
     * UserOrderMail constructor.
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
        return $this->subject(trans('general.order'))
            ->view('mails.user-order')
            ->text('mails.user-order-plain');
    }
}
