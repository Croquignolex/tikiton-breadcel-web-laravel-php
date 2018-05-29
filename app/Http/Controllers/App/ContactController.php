<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CartRequest|ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        Contact::create($request->all());

        flash_message(
            'Message', trans('contact.send'),
            font('envelope')
        );

        return redirect($this->redirectTo());
    }

    /**
     * Give the redirection path
     *
     * @return Router
     */
    private function redirectTo()
    {
        return route('contact.index');
    }
}
