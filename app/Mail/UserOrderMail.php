<?php

namespace App\Mail;

use App\Models\Order;

class UserOrderMail extends BaseOrderMail
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
        return $this->subject(trans('general.order'))
            ->view('mails.user-order')
            ->text('mails.user-order-plain');
    }
}
