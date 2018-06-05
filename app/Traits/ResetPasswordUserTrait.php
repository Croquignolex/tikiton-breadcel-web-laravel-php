<?php

namespace App\Traits;

use App\Models\User;
use Exception;

trait ResetPasswordUserTrait
{
    /**
     * @param array $credentials
     * @return null
     */
    protected function getUser(array $credentials)
    {
        try
        {
            return User::where([
                'email' => $credentials['email'],
                'is_admin' => false,
                'is_super_admin' => false
            ])->first();
        }
        catch(Exception $exception)
        {
            $this->databaseError();
            return null;
        }
    }
}