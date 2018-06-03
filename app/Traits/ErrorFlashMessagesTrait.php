<?php

namespace App\Traits;

trait ErrorFlashMessagesTrait
{
    /**
     *
     */
    public function databaseError()
    {
        $this->flashError('database_error');
    }

    /**
     *
     */
    public function mailError()
    {
        $this->flashError('mail_error');
    }

    /**
     * @param $message
     */
    private function flashError($message)
    {
        flash_message(
            trans('auth.error'), trans('general.' . $message),
            font('remove'), 'danger', 'bounceIn', 'bounceOut'
        );
    }
}