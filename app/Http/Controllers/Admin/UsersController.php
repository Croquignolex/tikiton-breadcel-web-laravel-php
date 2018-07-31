<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    use ErrorFlashMessagesTrait, PaginationTrait;

    const USER_ENABLE = 'activé';
    const USER_DISABLE = 'désactivé';
    const USER_ADMIN = 'administrateur';
    const USER_SUPER_ADMIN = 'super administrateur';

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
        $table_label = 'Utilisateurs';
        $users = null;

        try
        {
            $users = User::where('is_admin', true)->where('id', '<>',  Auth::user()->id)
                ->get()->sortByDesc('updated_at');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->paginate($request, $users, 10, 3);
        $paginationTools = $this->paginationTools;

        return view('admin.users.index', compact(
            'paginationTools', 'table_label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * @param RegisterRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RegisterRequest $request)
    {
        $this->userExist($request->input('email'));

        try
        {
            $user = new User();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->post_code = $request->input('post_code');
            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->company = $request->input('company');
            $user->is_admin = true;
            $user->password = Hash::make($request->input('password'));
            $user->save();

            flash_message(
                trans('auth.success'), $request->input('first_name') . ' ajouté(e) avec succèss',
                font('check')
            );

            return redirect(route('admin.users.show', [$user]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Router
     */
    public function destroy(Request $request, User $user)
    {
        try
        {
            if($user->is_super_admin && !Auth::user()->is_super_admin)
            {
                flash_message(
                    trans('auth.info'),
                    'Impossible de supprimer cet utilisateur car il est a un rôle plus élévé que le votre',
                    font('info-circle'), 'info'
                );
            }
            else
            {
                $user->delete();
                flash_message(
                    trans('auth.info'), 'Utilisateur ' . $user->format_full_name . ' supprimé avec succèss', font('info-circle'),
                    'info'
                );
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable(Request $request, User $user)
    {
        $this->toggleConfirmation($user, static::USER_DISABLE);
        return back();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(Request $request, User $user)
    {
        $this->toggleConfirmation($user, static::USER_ENABLE);
        return back();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function down(Request $request, User $user)
    {
        $this->toggleRole($user, static::USER_ADMIN);
        return back();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function up(Request $request, User $user)
    {
        $this->toggleRole($user, static::USER_SUPER_ADMIN);
        return back();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request, User $user)
    {
        try
        {
            $user->password = Hash::make('Bre@dcel2018');
            $user->save();
            flash_message(
                trans('auth.info'),
                'Le mot de passe de ' . $user->format_first_name . ' à été réinitialisé à "Bre@dcel2018".',
                font('info-circle'), 'info'
            );
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return back();
    }

    /**
     * @param $email
     */
    private function userExist($email)
    {
        if(User::where('email', $email)->count() > 0)
        {
            throw ValidationException::withMessages([
                'email' => 'Un utilisateur ou client exite deja avec cet email. Choisissez un autre email',
            ])->status(423);
        }
    }

    /**
     * Give the redirection path
     *
     * @return Router
     */
    private function redirectTo()
    {
        return redirect(route('admin.users.index'));
    }

    /**
     * @param User $user
     * @param $action
     */
    private function toggleConfirmation(User $user, $action)
    {
        $toggle = $action === static::USER_ENABLE;
        try
        {
            if($user->is_confirmed === $toggle || ($user->is_super_admin && !Auth::user()->is_super_admin))
            {
                flash_message(
                    trans('auth.error'), 'Cet utilisateur est déjà ' . $action . ' ou ne peut être ' . $action,
                    font('remove'), 'danger', 'bounceIn', 'bounceOut'
                );
            }
            else
            {
                $user->is_confirmed = $toggle;
                $user->token = str_random(64);
                $user->save();
                flash_message(
                    trans('auth.info'),
                    $user->format_first_name . ' est maintenant ' . $action,
                    font('info-circle'), 'info'
                );
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }
    }

    /**
     * @param User $user
     * @param $action
     */
    private function toggleRole(User $user, $action)
    {
        $toggle = true;
        if($action === static::USER_SUPER_ADMIN) $toggle = $user->is_super_admin === true;
        if($action === static::USER_ADMIN) $toggle = $user->is_admin === true;

        try
        {
            if(!Auth::user()->is_super_admin || $toggle)
            {
                flash_message(
                    trans('auth.error'), 'Cet utilisateur est déjà ' . $action . ' ou ne peut être un ' . $action,
                    font('remove'), 'danger', 'bounceIn', 'bounceOut'
                );
            }
            else
            {
                if($action === static::USER_SUPER_ADMIN) $toggle = !$toggle;
                $user->is_super_admin = $toggle;
                $user->save();
                flash_message(
                    trans('auth.info'),
                    $user->format_first_name . ' est maintenant ' . $action,
                    font('info-circle'), 'info'
                );
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }
    }
}
