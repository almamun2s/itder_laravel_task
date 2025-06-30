<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
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
}
