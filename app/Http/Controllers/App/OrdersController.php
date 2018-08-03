<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Mail\CancelOrderMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;

class OrdersController extends Controller
{
    use ErrorFlashMessagesTrait;

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        try
        {
            $orders = Auth::user()->orders->sortByDesc('created_at');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * @param Request $request
     * @param $language
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function cancel(Request $request, $language, Order $order)
    {
        try
        {
            if(Auth::user()->orders->contains($order))
            {
                if($order->status === Order::ORDERED)
                {
                    $order->status = Order::CANCELED;
                    $order->save();

                    $setting = Setting::where('is_activated', true)->first();
                    if ($setting !== null)
                    {
                        if ($setting->receive_email_from_canceled_order)
                        {
                            try
                            {
                                Mail::to(config('company.email_1'))->send(new CancelOrderMail($order));
                            }
                            catch (Exception $exception)
                            {
                                $this->mailError($exception);
                            }
                        }
                    }
                }
                else
                {
                    flash_message(
                        trans('auth.info'),
                        trans('general.order_canceled', ['order' => $order->reference]),
                        font('info-circle'), 'info'
                    );
                }
            }

            flash_message(trans('auth.error'), trans('auth.not_auth'),
                font('remove'), 'danger', 'bounceIn', 'bounceOut');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param $language
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show(Request $request, $language, Order $order)
    {
        try
        {
            if(Auth::user()->orders->contains($order))
                return view('orders.show', compact('order'));

            flash_message(trans('auth.error'), trans('auth.not_auth'),
                font('remove'), 'danger', 'bounceIn', 'bounceOut');
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
        return redirect(locale_route('orders.index'));
    }
}
