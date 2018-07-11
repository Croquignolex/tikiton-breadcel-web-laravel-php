<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return redirect(locale_route('home'));
        //return view('services');
    }
}
