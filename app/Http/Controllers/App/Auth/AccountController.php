<?php

namespace App\Http\Controllers\App\Auth;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\UserInfoUpdateRequest;
use App\Mail\UserPasswordResetUserMail;
use App\Mail\UserRegisterUserMail;
use App\Models\PasswordReset;
use Exception;
use App\Models\User;
use App\Models\Email;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Mail\NewCustomerMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;

class AccountController extends Controller
{
    use ErrorFlashMessagesTrait;

    const ADD_PRODUCT_TO_CART = 0;
    const REMOVE_PRODUCT_FROM_CART = 1;
    const ADD_PRODUCT_TO_WISH_LIST = 3;
    const REMOVE_PRODUCT_FROM_WISH_LIST = 4;

    const LIGHT_JSON_RESPONSE = 5;
    const NORMAL_JSON_RESPONSE = 6;

    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->only('validation');
        $this->middleware('auth')->except('validation');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('account.index', compact('user'));
    }

    /**
     * @param UserInfoUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserInfoUpdateRequest $request)
    {
        try
        {
            $user = Auth::user();
            $user->update($request->all());
            flash_message(
                trans('auth.success'),
                trans('general.info_updated')
            );
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function password()
    {
        try
        {
            $user = Auth::user();
            $password_reset = PasswordReset::where(['email' => $user->email])->first();

            if(is_null($password_reset)) PasswordReset::create(['email' => $user->email]);
            else
            {
                $password_reset->token = str_random(64);
                $password_reset->save();
            }

            try
            {
                Mail::to($user)->send(new UserPasswordResetUserMail($user));
                flash_message(
                    trans('auth.info'), trans('passwords.sent'), font('info-circle'),
                    'info', 'flipInY', 'flipOutX'
                );
            }
            catch (Exception $exception)
            {
                $this->mailError($exception);
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function email()
    {
        return view('account.email');
    }

    /**
     * @param EmailRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendLink(EmailRequest $request)
    {
        try
        {
            $user = Auth::user();
            $user->email = $request->email;
            $user->is_confirmed = false;
            $user->save();

            try
            {
                Mail::to($user)->send(new UserRegisterUserMail($user));

                flash_message(
                    trans('auth.info'), trans('auth.email_sent'), font('info-circle'),
                    'info', 'flipInY', 'flipOutX'
                );
            }
            catch (Exception $exception)
            {
                $this->databaseError($exception);
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

                $setting = Setting::where('is_activated', true)->first();
                if($setting !== null)
                {
                    if($setting->receive_email_from_register)
                    {
                        $to = new Email();
                        $to->email = config('company.email_1');
                        $to->name = config('company.name');
                        try
                        {
                            Mail::to($to)->send(new NewCustomerMail($user));
                        }
                        catch (Exception $exception)
                        {
                            $this->mailError($exception);
                        }
                    }
                }
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

        return redirect(locale_route('login'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function redirectTo()
    {
        return redirect(locale_route('account.index'));
    }
}
