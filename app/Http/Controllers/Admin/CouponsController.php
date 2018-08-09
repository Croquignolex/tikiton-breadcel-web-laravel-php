<?php

namespace App\Http\Controllers\Admin;

use App\Mail\UserCouponMail;
use Exception;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Support\Facades\Mail;

class CouponsController extends Controller
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
        $table_label = 'Coupons (tous)';
        $coupons = null;

        try
        {
            $coupons = Coupon::all()->sortByDesc('updated_at');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->paginate($request, $coupons, 10, 3);
        $paginationTools = $this->paginationTools;

        return view('admin.coupons.index', compact(
            'paginationTools', 'table_label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = User::where('is_admin', false)
            ->where('is_super_admin', false)
            ->where('is_confirmed', true)
            ->get();
        return view('admin.coupons.create', compact('customers'));
    }

    /**
     * @param CouponRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CouponRequest $request)
    {
        $couponCustomerIds = $request->input('customers');
        try
        {
            $coupon = Coupon::create($request->all());

            if(!is_null($couponCustomerIds))
            {
                foreach ($couponCustomerIds as $customerId)
                {
                    $user = User::find(intval($customerId));
                    $coupon->users()->save($user);

                    if($user->is_confirmed && !$user->is_admin && !$user->is_super_admin)
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
            success_flash_message(trans('auth.success'), 'Coupon ajouté avec succèss');
            return redirect(route('admin.coupons.show', [$coupon]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param Coupon $coupon
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    }

    /**
     * @param Request $request
     * @param Coupon $coupon
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Coupon $coupon)
    {
        $customers = User::where('is_admin', false)
            ->where('is_super_admin', false)
            ->where('is_confirmed', true)
            ->get();
        $tabTCustomerIds = [];
        foreach ($coupon->users as $user) $tabTCustomerIds[] = $user->id;
        return view('admin.coupons.edit', compact('coupon', 'tabTCustomerIds', 'customers'));
    }

    /**
     * @param CouponRequest $request
     * @param Coupon $coupon
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $couponCustomerIds = $request->input('customers');
        try
        {
            $coupon->update($request->all());

            //Remove all products tags first
            foreach ($coupon->user_coupons as $user_coupon)
                $user_coupon->delete();
            //Add new product tags
            if(!is_null($couponCustomerIds))
            {
                foreach ($couponCustomerIds as $customerId)
                {
                    $user = User::find(intval($customerId));
                    $coupon->users()->save($user);

                    if($user->is_confirmed && !$user->is_admin && !$user->is_super_admin)
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
            success_flash_message(trans('auth.success'), 'Coupon mis à jour avec succèss');
            return redirect(route('admin.coupons.show', [$coupon]));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param Coupon $coupon
     * @return Router
     */
    public function destroy(Request $request, Coupon $coupon)
    {
        try
        {
            $coupon->delete();
            info_flash_message(trans('auth.info'), 'Coupon supprimé avec succèss');
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
        return redirect(route('admin.coupons.index'));
    }
}
