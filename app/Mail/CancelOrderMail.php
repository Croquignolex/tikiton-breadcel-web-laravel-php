<?php

namespace App\Mail;

use App\Models\Order;

class CancelOrderMail extends BaseOrderMail
{
    /**
     * Create a new message instance.
     *
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
        return $this->subject('Commande annulée')
            ->view('mails.cancel-order')
            ->text('mails.cancel-order-plain');
    }
}
