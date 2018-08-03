<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;

class DashboardController extends Controller
{
    use ErrorFlashMessagesTrait;

    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
        $this->middleware('ajax')->only('fill');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        try
        {
            $messages_nbr = Contact::all()->count();
            $monthly_messages_nbr = Contact::where('created_at', '>=', now()->startOfMonth())
                ->where('created_at', '<=' , now()->endOfMonth())
                ->count();

            $customers_nbr = User::where('is_admin', false)
                ->where('is_super_admin', false)->count();
            $monthly_customers_nbr = User::where('is_admin', false)
                ->where('is_super_admin', false)
                ->where('created_at', '>=', now()->startOfMonth())
                ->where('created_at', '<=' , now()->endOfMonth())
                ->count();

            $orders_nbr = Order::where('status', '<>', Order::CANCELED)->count();
            $monthly_orders_nbr = Order::where('status', '<>', Order::CANCELED)
                ->where('created_at', '>=', now()->startOfMonth())
                ->where('created_at', '<=' , now()->endOfMonth())
                ->count();

            $incomes = Order::where('status', Order::SOLD)->get()->sum(function (Order $order) {
                return $order->products->sum(function (Product $product) {
                    if($product->is_a_discount) return $product->calculateProductDiscountValue();
                    else return $product->calculateProductValue();
                }) - $order->discount;
            });

            $monthly_incomes = Order::where('status', Order::SOLD)
                ->where('updated_at', '>=', now()->startOfMonth())
                ->where('updated_at', '<=' , now()->endOfMonth())
                ->get()->sum(function (Order $order) {
                return $order->products->sum(function (Product $product) {
                    if($product->is_a_discount) return $product->calculateProductDiscountValue();
                    else return $product->calculateProductValue();
                })  - $order->discount;
            });
        }
        catch (Exception $exception)
        {
            dd($exception);
            $this->databaseError($exception);
        }

        return view('admin.dashboard', compact(
            'messages_nbr', 'monthly_messages_nbr', 'customers_nbr',
            'monthly_customers_nbr', 'orders_nbr', 'monthly_orders_nbr', 'incomes',
            'monthly_incomes'
        ));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function fill()
    {
        $incomes = [];
        $products = Product::all();

        $ordered_orders = Order::where('status', Order::ORDERED)->count();
        $progress_orders = Order::where('status', Order::PROGRESS)->count();
        $sold_orders = Order::where('status', Order::SOLD)->count();
        $canceled_orders = Order::where('status', Order::CANCELED)->count();

        $confirmed_users = User::all()->where('is_admin', false)
            ->where('is_super_admin', false)
            ->where('is_confirmed', true)->count();
        $unconfirmed_users = User::all()->where('is_admin', false)
            ->where('is_super_admin', false)
            ->where('is_confirmed', false)->count();

        for($i = 1; $i <= 12; $i++)
        {
            $incomes[] = Order::where('status', Order::SOLD)
                ->where('updated_at', '>=', now()->month($i)->startOfMonth())
                ->where('updated_at', '<=' , now()->month($i)->endOfMonth())
                ->get()->sum(function (Order $order) {
                    return $order->products->sum(function (Product $product) {
                            if($product->is_a_discount) return $product->calculateProductDiscountValue();
                            else return $product->calculateProductValue();
                        })  - $order->discount;
                });
        }

        return response()->json(compact(
            'products', 'ordered_orders', 'progress_orders', 'sold_orders',
            'canceled_orders', 'confirmed_users', 'unconfirmed_users', 'incomes'));
    }
}
