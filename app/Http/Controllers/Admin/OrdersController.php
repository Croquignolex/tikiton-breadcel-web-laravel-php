<?php

namespace App\Http\Controllers\Admin;

use App\Mail\UserProgressOrderMail;
use App\Mail\UserSoldOrderMail;
use Exception;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
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
        $orders = null;
        $filter = intval($request->query('type'));
        if($filter === Order::PROGRESS) $table_label = 'Commandes en cours';
        elseif($filter === Order::CANCELED) $table_label = 'Commandes annulées';
        elseif($filter === Order::ORDERED) $table_label = 'Commandes passées';
        elseif($filter === Order::SOLD) $table_label = 'Commandes livrées';
        elseif($filter === Order::ALL) $table_label = 'Commandes (toutes)';
        else $table_label = 'Filtre inconnu';

        try
        {
            if($filter === Order::ALL) $orders = Order::all()->sortByDesc('updated_at');
            elseif($filter === Order::PROGRESS || $filter === Order::CANCELED ||
                $filter === Order::ORDERED || $filter === Order::SOLD)
                $orders = Order::where('status', $filter)->get()->sortByDesc('updated_at');
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        $this->paginate($request, $orders, 10, 3);
        $paginationTools = $this->paginationTools;

        return view('admin.orders.index', compact(
            'paginationTools', 'table_label'));
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function progress(Request $request, Order $order)
    {
        try
        {
            if($order->status !== Order::PROGRESS)
            {
                $order->status = Order::PROGRESS;
                $order->save();

                try
                {
                    Mail::to($order->user->email)->send(new UserProgressOrderMail($order));
                }
                catch (Exception $exception)
                {
                    $this->mailError($exception);
                }
                info_flash_message(trans('auth.info'), 'La commande ' . $order->reference . ' à été validée');
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return back();
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sold(Request $request, Order $order)
    {
        try
        {
            if($order->status !== Order::CANCELED)
            {
                $canSold = true;
                foreach ($order->products as $product) {
                    if($product->stock < $product->pivot->quantity)
                    {
                        danger_flash_message(trans('auth.error'), 'Impossible de livrer cette commande car la quantité requis du produit ' . $product->format_name . ' dépasse la quantité présente en stock');
                        $canSold = false;
                        break;
                    }
                }

                if($canSold)
                {
                    foreach ($order->products as $product) {
                        $product->stock = $product->stock - $product->pivot->quantity;
                        $product->save();
                    }

                    $order->status = Order::SOLD;
                    $order->save();

                    try
                    {
                        Mail::to($order->user->email)->send(new UserSoldOrderMail($order));
                    }
                    catch (Exception $exception)
                    {
                        $this->mailError($exception);
                    }
                    info_flash_message(trans('auth.info'), 'La commande ' . $order->reference . ' à été livrée');
                }
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return back();
    }
}
