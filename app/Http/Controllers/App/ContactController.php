<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Models\Setting;
use App\Traits\ErrorFlashMessagesTrait;
use Exception;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    use ErrorFlashMessagesTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ContactRequest $request)
    {
        try
        {
            $contact = Contact::create($request->all());

            flash_message(
                'auth.success', trans('contact.send'),
                font('envelope')
            );

            $setting = Setting::find(1);

            try
            {
                if($setting->receive_email_from_contact)
                {
                    Mail::to(config('company.email_1'))->send(new ContactFormMail($contact));
                }
            }
            catch (Exception $exception) {}
        }
        catch (Exception $exception)
        {
            $this->databaseError();
        }

        return redirect(locale_route('contact.index'));
    }
}
