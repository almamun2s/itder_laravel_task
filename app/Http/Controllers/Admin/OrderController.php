<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Enum\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Showing orders to admin
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Showing Order details page to admin
     * @param \App\Models\Order $order
     */
    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }

    /**
     * Update Order Status
     * @param \Illuminate\Http\Request $request
     * @param mixed $order
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function status_update(Request $request, $order)
    {
        $order = Order::findOrFail($order);
        if (!OrderStatus::isValidValue($request->order_status)) {
            return redirect()->back();
        }
        $order->status = $request->order_status;
        $order->save();

        toastr()->success('Order Status Updated.');
        return redirect()->back();
    }
}
