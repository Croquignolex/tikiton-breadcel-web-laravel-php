<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Coupon;

class UserCouponMail extends BaseUserMail
{
    public $coupon;

    /**
     * UserOrderMail constructor.
     * @param User $user
     * @param Coupon $coupon
     */
    public function __construct(User $user, Coupon $coupon)
    {
        parent::__construct($user);
        $this->coupon = $coupon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('general.your_coupon'))
            ->view('mails.user-coupon')
            ->text('mails.user-coupon-plain');
    }
}
