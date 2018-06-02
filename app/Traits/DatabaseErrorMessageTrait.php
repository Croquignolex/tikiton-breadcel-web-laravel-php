<?php

namespace App\Traits;

trait DatabaseErrorMessageTrait
{
    /**
     *
     */
    public function databaseError()
    {
        flash_message(
            trans('auth.error'), trans('general.database_error'),
            font('remove'), 'danger', 'bounceIn', 'bounceOut'
        );
    }
}