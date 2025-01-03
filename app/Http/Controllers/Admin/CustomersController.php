<?php

namespace App\Http\Controllers\Admin;

use App\Mail\UserCouponMail;
use Exception;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Mail\UserRegisterMail;
use App\Traits\PaginationTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Validation\ValidationException;

class CustomersController extends Controller
{
    use ErrorFlashMessagesTrait, PaginationTrait;

    const CUSTOMER_ENABLE = 'activé';
    const CUSTOMER_DISABLE = 'désactivé';

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
        $customers = null;
        $filter = intval($request->query('type'));
        if($filter === User::CUSTOMER_HAS_ORDER) $table_label = 'Clients qui ont déjà commandé';
        elseif($filter === User::CUSTOMER_HAS_NOT_ORDER) $table_label = 'Clients qui n\'ont pas encore commandé';
        elseif($filter === User::ALL) $table_label = 'Clients (tous)';
        else $table_label = 'Filtre inconnu';

        try
        {
            if($filter === User::ALL) $customers = User::all()->where('is_admin', false)
                ->where('is_super_admin', false)->sortByDesc('updated_at');
            elseif($filter === User::CUSTOMER_HAS_ORDER)
            {
                $customers = User::all()->where('is_admin', false)
                    ->where('is_super_admin', false)->filter(function (User $customer) {
                    return !$customer->orders->isEmpty();
                })->sortByDesc('updated_at');
            }
            elseif($filter === User::CUSTOMER_HAS_NOT_ORDER)
            {
                $customers = User::all()->where('is_admin', false)
                    ->where('is_super_admin', false)->filter(function (User $customer) {
                        return $customer->orders->isEmpty();
                })->sortByDesc('updated_at');
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->paginate($request, $customers, 10, 3);
        $paginationTools = $this->paginationTools;

        return view('admin.customers.index', compact(
            'paginationTools', 'table_label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * @param RegisterRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RegisterRequest $request)
    {
        $this->customerExist($request->input('email'));
        $customerCouponIds = $request->input('coupons');
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
            $user->password = Hash::make($request->input('password'));
            $user->save();

            if(!is_null($customerCouponIds))
            {
                foreach ($customerCouponIds as $couponId)
                {
                    $coupon = Coupon::find(intval($couponId));
                    $user->coupons()->save($coupon);

                    if(!$user->is_admin && !$user->is_super_admin)
                    {
                        try
                        {
                            Mail::to($user->email)->send(new UserCouponMail($user, $coupon));
                        }
                        catch (Exception $exception)
                        {
                            $this->mailError($exception);
                        }
                    }
                }
            }

            try
            {
                Mail::to($user->email)->send(new UserRegisterMail($user));
                success_flash_message(trans('auth.success'), $request->input('first_name') . ' ajouté(e) avec succèss');
            }
            catch (Exception $exception)
            {
                $user->delete();
                $this->databaseError($exception);
            }

            return redirect(route('admin.customers.show', [$user]));
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
        return view('admin.customers.show', compact('user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable(Request $request, User $user)
    {
        $this->toggleConfirmation($user, static::CUSTOMER_DISABLE);
        return back();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(Request $request, User $user)
    {
        $this->toggleConfirmation($user, static::CUSTOMER_ENABLE);
        return back();
    }

    /**
     * @param $email
     */
    private function customerExist($email)
    {
        if(User::where('email', $email)->count() > 0)
        {
            throw ValidationException::withMessages([
                'email' => 'Un client exite deja avec cet email. Choisissez un autre email',
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
        return redirect(route('admin.customers.index'));
    }

    /**
     * @param User $user
     * @param $action
     */
    private function toggleConfirmation(User $user, $action)
    {
        $toggle = $action === static::CUSTOMER_ENABLE;
        try
        {
            if($user->is_confirmed === $toggle || $user->is_admin === true || $user->is_super_admin === true)
                danger_flash_message(trans('auth.error'), 'Ce client est déjà '. $action .' ou ne peut être ' . $action);
            else
            {
                $user->is_confirmed = $toggle;
                $user->token = str_random(64);
                $user->save();
                info_flash_message(trans('auth.info'), $user->format_first_name . ' est maintenant ' . $action);
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }
    }
}
