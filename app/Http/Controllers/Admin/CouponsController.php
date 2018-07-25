<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Traits\ErrorFlashMessagesTrait;

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
        return view('admin.coupons.create');
    }

    /**
     * @param CouponRequest $request
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CouponRequest $request)
    {
        try
        {
            $coupon = Coupon::create($request->all());
            flash_message(
                trans('auth.success'), 'Coupon ajouté avec succèss',
                font('check')
            );

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
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * @param CouponRequest $request
     * @param Coupon $coupon
     * @return Router|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        try
        {
            $coupon->update($request->all());
            flash_message(
                trans('auth.success'), 'Coupon mis à jour avec succèss',
                font('check')
            );

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
            flash_message(
                trans('auth.info'), 'Coupon supprimé avec succèss',
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
        return redirect(route('admin.coupons.index'));
    }
}
