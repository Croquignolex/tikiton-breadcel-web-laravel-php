<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Team;
use App\Models\About;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;

class AboutController extends Controller
{
    use ErrorFlashMessagesTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        try
        {
            $about = About::all()->first();
            $teams = Team::all();
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return view('about', compact('teams', 'about'));
    }
}
