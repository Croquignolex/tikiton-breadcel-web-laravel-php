<?php

namespace App\Mail;

use App\Models\Order;

class UserProgressOrderMail extends BaseOrderMail
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
            ->view('mails.user-progress-order')
            ->text('mails.user-progress-order-plain');
    }
}
