<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Traits\DatabaseErrorMessageTrait;
use Exception;

class ContactController extends Controller
{
    use DatabaseErrorMessageTrait;

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
            Contact::create($request->all());

            flash_message(
                'auth.success', trans('contact.send'),
                font('envelope')
            );

            return redirect(locale_route('contact.index'));
        }
        catch (Exception $exception)
        {
            $this->databaseError();
        }

        return back();
    }
}
