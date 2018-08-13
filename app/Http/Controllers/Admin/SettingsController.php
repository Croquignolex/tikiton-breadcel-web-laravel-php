<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    use ErrorFlashMessagesTrait, PaginationTrait;

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
        $table_label = 'Paramètres';
        $settings = null;

        try
        {
            $settings = Setting::all()->sortByDesc('updated_at');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->paginate($request, $settings, 10, 3);
        $paginationTools = $this->paginationTools;

        return view('admin.settings.index', compact(
            'paginationTools', 'table_label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * @param SettingRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SettingRequest $request)
    {
        $this->settingExist($request->input('label'));

        try
        {
            $setting = Setting::create([
                'label' => $request->input('label'),
                'slogan' => $request->input('slogan'),
                'address_1' => $request->input('address_1'),
                'address_2' => $request->input('address_2'),
                'phone_1' => $request->input('phone_1'),
                'phone_2' => $request->input('phone_2'),
                'tva' => $request->input('tva'),
                'receive_email_from_contact' => is_null($request->input('email_new_message')) ? false : true,
                'receive_email_from_register' => is_null($request->input('email_new_customer')) ? false : true,
                'receive_email_from_new_order' => is_null($request->input('email_new_order')) ? false : true,
                'receive_email_from_canceled_order' => is_null($request->input('email_order_cancel')) ? false : true,
                'order_activated' => is_null($request->input('order_activated')) ? false : true,
                'facebook' => $request->input('facebook'),
                'twitter' => $request->input('twitter'),
                'linkedin' => $request->input('linkedin'),
                'googleplus' => $request->input('googleplus'),
                'youtube' => $request->input('youtube')
            ]);

            success_flash_message(trans('auth.success'), 'Paramètre ' . $request->input('label') . ' ajouté avec succèss');
            return redirect(route('admin.settings.show', [$setting]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param Setting $setting
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Setting $setting)
    {
        return view('admin.settings.show', compact('setting'));
    }

    /**
     * @param Request $request
     * @param Setting $setting
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * @param SettingRequest $request
     * @param Setting $setting
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        $this->settingExist($request->input('label'), $setting->id);

        try
        {
            $setting->update([
                'label' => $request->input('label'),
                'slogan' => $request->input('slogan'),
                'address_1' => $request->input('address_1'),
                'address_2' => $request->input('address_2'),
                'phone_1' => $request->input('phone_1'),
                'phone_2' => $request->input('phone_2'),
                'tva' => $request->input('tva'),
                'receive_email_from_contact' => is_null($request->input('email_new_message')) ? false : true,
                'receive_email_from_register' => is_null($request->input('email_new_customer')) ? false : true,
                'receive_email_from_new_order' => is_null($request->input('email_new_order')) ? false : true,
                'receive_email_from_canceled_order' => is_null($request->input('email_order_cancel')) ? false : true,
                'order_activated' => is_null($request->input('order_activated')) ? false : true,
                'facebook' => $request->input('facebook'),
                'twitter' => $request->input('twitter'),
                'linkedin' => $request->input('linkedin'),
                'googleplus' => $request->input('googleplus'),
                'youtube' => $request->input('youtube')
            ]);

            success_flash_message(trans('auth.success'), 'Le paramètre ' . $request->input('label') . ' à été mis(e) à jour avec succèss');
            return redirect(route('admin.settings.show', [$setting]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param Setting $setting
     * @return Router
     */
    public function destroy(Request $request, Setting $setting)
    {
        try
        {
            if($setting->is_activated)
                info_flash_message( trans('auth.info'), 'Impossible de supprimer ce paramètre car il est actif, désactivez le d\'abord');
            else
            {
                $setting->delete();
                info_flash_message(trans('auth.info'), 'Paramètre ' . $setting->label . ' supprimé avec succèss', font('info-circle'));
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
     * @param Setting $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function apply(Request $request, Setting $setting)
    {
        try
        {
            if(!$setting->is_activated)
            {
                $settings = Setting::all();
                foreach ($settings as $_setting)
                {
                    $_setting->is_activated = false;
                    $_setting->save();
                }
                $setting->is_activated = true;
                $setting->save();
            }
            info_flash_message(trans('auth.info'), 'Le paramètre ' . $setting->label. ' est maintant actif');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return back();
    }

    /**
     * @param $label
     * @param int $setting_id
     */
    private function settingExist($label, $setting_id = 0)
    {
        if(Setting::where('label', $label)->where('id', '<>', $setting_id)->count() > 0)
        {
            throw ValidationException::withMessages([
                'label' => 'Un paramètre exite deja avec ce libéllé',
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
        return redirect(route('admin.settings.index'));
    }
}
