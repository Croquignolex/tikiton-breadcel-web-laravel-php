<?php

namespace App\Http\Controllers\App\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;

class AccountController extends Controller
{
    use ErrorFlashMessagesTrait;

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->only('validation_unnamed', 'validation');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('account.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function wishlist()
    {
        return view('account.wishlist');
    }

    /**
     * @param Request $request
     * @param $email
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function validation_unnamed(Request $request, $email, $token)
    {
        return redirect(locale_route('account.validation', compact('email', 'token')));
    }

    /**
     * @param Request $request
     * @param $language
     * @param $email
     * @param $token
     * @return string
     */
    public function validation(Request $request, $language, $email, $token)
    {
        try
        {
            $user = User::where([
                'token' => $token, 'email' => $email, 'is_confirmed' => false,
                'is_admin' => false, 'is_super_admin' => false
            ])->first();

            if($user === null)
            {
                flash_message(
                    trans('auth.error'), trans('general.bad_link'),
                    font('remove'), 'danger', 'bounceIn', 'bounceOut'
                );
            }
            else
            {
                $user->is_confirmed = true;
                $user->token = str_random(64);
                $user->save();

                flash_message(
                    trans('auth.success'),
                    trans('general.well_confirmed', ['name' => $user->name])
                );
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return redirect(locale_route('login.show'));
    }
}
