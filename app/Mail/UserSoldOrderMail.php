<?php

namespace App\Mail;

use App\Models\Order;

class UserSoldOrderMail extends BaseOrderMail
{
    /**
     * UserOrderMail constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('general.your_order'))
            ->view('mails.user-sold-order')
            ->text('mails.user-sold-order-plain');
    }
}