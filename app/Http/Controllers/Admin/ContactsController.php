<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;

class ContactsController extends Controller
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
        $table_label = 'Messages';
        $contacts = null;

        try
        {
            $contacts = Contact::all()->sortByDesc('created_at');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->paginate($request, $contacts, 10, 3);
        $paginationTools = $this->paginationTools;

        return view('admin.contacts.index', compact(
            'paginationTools', 'table_label'));
    }

    /**
     * @param Request $request
     * @param Contact $contact
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Contact $contact)
    {
        try
        {
            if(!$contact->is_read)
            {
                $contact->is_read = true;
                $contact->save();
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * @param Request $request
     * @param Contact $contact
     * @return Router
     */
    public function destroy(Request $request, Contact $contact)
    {
        try
        {
            $contact->delete();
            flash_message(
                trans('auth.info'), 'Le message de ' . $contact->format_name . '  supprimé avec succèss',
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
        return redirect(route('admin.contacts.index'));
    }
}
