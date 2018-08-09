<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Requests\ProfileInfoUpdateRequest;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordRequest;
use App\Traits\ErrorFlashMessagesTrait;
use App\Http\Requests\UserInfoUpdateRequest;

class ProfileController extends Controller
{

    use ErrorFlashMessagesTrait;

    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password()
    {
        $user = Auth::user();
        return view('admin.profile.password', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function email()
    {
        $user = Auth::user();
        return view('admin.profile.email', compact('user'));
    }

    public function update(ProfileInfoUpdateRequest $request)
    {
        try
        {
            $user = Auth::user();
            $user->update($request->all());
            success_flash_message(trans('auth.success'), trans('general.info_updated'));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    public function updatePassword(PasswordRequest $request)
    {
        try
        {
            $user = Auth::user();
            if(Hash::check($request->input('old_password'), $user->password))
            {
                $user->password = Hash::make($request->input('password'));
                $user->save();
                success_flash_message(trans('auth.success'), trans('passwords.changed'));
            }
            else
            {
                danger_flash_message(trans('auth.error'), trans('passwords.password_not_match'));
                return redirect(route('admin.profile.password'));
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param EmailRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateEmail(EmailRequest $request)
    {
        try
        {
            $user = Auth::user();
            $user->email = $request->email;
            $user->save();
            info_flash_message(trans('auth.info'), 'Votre email à été mis à jour avec success');
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
    private function redirectTo()
    {
        return redirect(route('admin.profile.index'));
    }
}
