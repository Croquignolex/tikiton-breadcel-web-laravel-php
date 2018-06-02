<?php

namespace App\Http\Controllers\App\Auth;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @return string
     */
    public function confirmed()
    {
        return 'ok';
    }
}
