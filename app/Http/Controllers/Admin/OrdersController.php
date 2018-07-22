<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Traits\PaginationTrait;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;

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
        elseif($filter === Order::ALL) $table_label = 'Toutes les commandes';
        else $table_label = 'Filtre inconnu';

        try
        {
            if($filter === Order::ALL) $orders = Order::all()->sortByDesc('created_at');
            elseif($filter === Order::PROGRESS || $filter === Order::CANCELED ||
                $filter === Order::ORDERED || $filter === Order::SOLD)
                $orders = Order::where('status', $filter)->get()->sortByDesc('created_at');
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

                flash_message(
                    trans('auth.info'),
                    'La commande ' . $order->reference . ' à été validée',
                    font('info-circle'), 'info'
                );
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
                        flash_message(
                            trans('auth.error'), 'Impossible de livrer cette commande car la quantité requis du produit ' . $product->format_name . ' dépasse la quantité présente en stock',
                            font('remove'), 'danger', 'bounceIn', 'bounceOut'
                        );
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

                    flash_message(
                        trans('auth.info'),
                        'La commande ' . $order->reference . ' à été livrée',
                        font('info-circle'), 'info'
                    );
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
