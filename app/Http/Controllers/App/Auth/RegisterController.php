<?php

namespace App\Http\Controllers\App\Auth;

use Exception;
use App\Models\User;
use App\Mail\UserRegisterMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, ErrorFlashMessagesTrait;

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    {
        try
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            try
            {
                Mail::to($user)->send(new UserRegisterMail($user));

                flash_message(
                    trans('auth.success'), trans('auth.registration_message'),
                    font('check')
                );
            }
            catch (Exception $exception)
            {
                $user->delete();
                $this->databaseError($exception);
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return redirect(locale_route('register.show'));
    }
}