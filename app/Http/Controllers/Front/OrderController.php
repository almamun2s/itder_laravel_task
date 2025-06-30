<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Enum\OrderStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    /**
     * Creates the order
     * @param \Illuminate\Http\Request $request
     */
    public function create_order(Request $request)
    {
        if (Cart::count() == 0) {
            return redirect()->back();
        }

        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        do {
            $orderNumber = Str::random(15);
        } while (Order::where('order_number', $orderNumber)->exists());
        $totalAmount = CartController::totalAmount(Cart::total());
        $totalAmount = (float) str_replace(',', '', $totalAmount);

        $order = Order::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'products' => Cart::content(),
            'order_number' => $orderNumber,
            'user_id' => Auth::user()?->id,
            'total_amount' => $totalAmount,
        ]);

        Cart::destroy();

        return redirect()->route('order_details', $orderNumber);
    }


    /**
     * Showing Order to customer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->latest()->get();
        return view('front.order.index', compact('orders'));
    }
    /**
     * Order Details page
     * @param string $orderNumber
     */
    public function order_details($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        return view('front.order.order_details', compact('order'));
    }

    // ============================================= For Admins =============================================
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
