<?php

namespace App\Http\Controllers\App;

use App\Mail\CancelOrderMail;
use App\Mail\NewOrderMail;
use App\Mail\UserOrderMail;
use App\Models\Email;
use App\Models\Order;
use Exception;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        if($this->authorization($order, Order::CANCELED))
        {
            $setting = Setting::where('is_activated', true)->first();
            if ($setting !== null)
            {
                if ($setting->receive_email_from_canceled_order)
                {
                    $to = new Email();
                    $to->email = config('company.email_1');
                    $to->name = config('company.name');
                    try
                    {
                        Mail::to($to)->send(new CancelOrderMail($order));
                    }
                    catch (Exception $exception)
                    {
                        $this->mailError($exception);
                    }
                }
            }

            flash_message(
                trans('auth.info'),
                trans('general.order_canceled', ['order' => $order->reference]),
                font('info-circle'), 'info'
            );
        }
        return $this->redirectTo();
    }

    /**
     * @param Request $request
     * @param $language
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function order(Request $request, $language, Order $order)
    {
        if($this->authorization($order, Order::ORDERED))
        {
            flash_message(
                trans('auth.info'),
                trans('general.order_ordered', ['order' => $order->reference]),
                font('info-circle'), 'info'
            );
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
     * @param Order $order
     * @param $action
     * @return bool
     */
    private function authorization(Order $order, $action)
    {
        try
        {
            if(Auth::user()->orders->contains($order))
            {
                if($order->status !== Order::PROGRESS && $order->status !== Order::SOLD)
                {
                    $order->status = $action;
                    $order->save();
                    return true;
                }
            }

            flash_message(trans('auth.error'), trans('auth.not_auth'),
                font('remove'), 'danger', 'bounceIn', 'bounceOut');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }
        return false;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function redirectTo()
    {
        return redirect(locale_route('orders.index'));
    }
}
