<?php

namespace App\Mail;

use App\Models\Order;

class NewOrderMail extends BaseOrderMail
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
        return $this->subject('Nouvelle commande')
            ->view('mails.new-order')
            ->text('mails.new-order-plain');
    }
}
