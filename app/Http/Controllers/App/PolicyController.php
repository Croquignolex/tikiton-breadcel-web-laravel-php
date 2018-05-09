<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class PolicyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('policy.index');
    }
}
