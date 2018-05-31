<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Team;

class AboutController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        $teams = Team::all();
        return view('about.index', compact('teams'));
    }
}
