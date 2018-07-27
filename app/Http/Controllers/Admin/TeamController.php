<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Traits\ImageManageTrait;
use App\Http\Requests\TeamRequest;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;

class TeamController extends Controller
{
    use ErrorFlashMessagesTrait, PaginationTrait, ImageManageTrait;

    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $table_label = 'Equipe';
        $teams = null;

        try
        {
            $teams = Team::all()->sortByDesc('updated_at');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->paginate($request, $teams, 10, 3);
        $paginationTools = $this->paginationTools;

        return view('admin.teams.index', compact(
            'paginationTools', 'table_label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * @param TeamRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TeamRequest $request)
    {
        $image = $this->storeImage($request, 'teams');

        try
        {
            $team = Team::create([
                'name' => $request->input('name'),
                'fr_function' => $request->input('fr_description'),
                'en_function' => $request->input('en_description'),
                'fr_description' => $request->input('fr_description'),
                'en_description' => $request->input('en_description'),
                'facebook' => $request->input('fr_description'),
                'twitter' => $request->input('en_description'),
                'linkedin' => $request->input('fr_description'),
                'googleplus' => $request->input('en_description'),
                'image' => $image->name,
                'extension' => $image->extension
            ]);

            flash_message(
                trans('auth.success'), 'Membre ' . $request->input('name') . ' ajouté avec succèss',
                font('check')
            );

            return redirect(route('admin.teams.show', [$team]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Team $team)
    {
        return view('admin.teams.show', compact('team'));
    }

    /**
     * @param Request $request
     * @param Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    /**
     * @param TeamRequest $request
     * @param Team $team
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TeamRequest $request, Team $team)
    {
        $image = $this->storeImage($request, 'teams', $team);

        try
        {
            $team->update([
                'name' => $request->input('name'),
                'fr_function' => $request->input('fr_description'),
                'en_function' => $request->input('en_description'),
                'fr_description' => $request->input('fr_description'),
                'en_description' => $request->input('en_description'),
                'facebook' => $request->input('fr_description'),
                'twitter' => $request->input('en_description'),
                'linkedin' => $request->input('fr_description'),
                'googleplus' => $request->input('en_description'),
                'image' => $image->name,
                'extension' => $image->extension
            ]);

            flash_message(
                trans('auth.success'), 'Le membre ' . $request->input('name') . ' à été mis(e) à jour avec succèss',
                font('check')
            );

            return redirect(route('admin.teams.show', [$team]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param Team $team
     * @return Router
     */
    public function destroy(Request $request, Team $team)
    {
        try
        {
            $this->deleteImage($team, 'teams');
            $team->delete();
            flash_message(
                trans('auth.info'), 'Le membre ' . $team->format_name . '  supprimé avec succèss',
                font('info-circle'), 'info'
            );
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * Give the redirection path
     *
     * @return Router
     */
    private function redirectTo()
    {
        return redirect(route('admin.teams.index'));
    }
}
