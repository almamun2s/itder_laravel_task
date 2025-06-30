<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Showing Cart Page
     */
    public function index()
    {
        $cart = Cart::content();
        return view('front.cart', compact('cart'));
    }

    /**
     * Add items to cart
     */
    public function add_to_cart(Request $request, Product $product)
    {
        $price = $product->discount_price ?: $product->price;
        Cart::add($product->id, $product->name, 1, $price, ['image' => $product->getImg()]);

        return redirect()->back();
    }

    /**
     * Storing products to cart
     * @param \Illuminate\Http\Request $request
     */
    public function store_to_cart(Request $request)
    {
        $quantity = (int) $request->quantity;
        $product = Product::findOrFail($request->product_id);
        $price = $product->discount_price ?: $product->price;
        Cart::add($product->id, $product->name, $quantity, $price, ['image' => $product->getImg()]);

        return redirect()->back();
    }

    /**
     * Adding Quantity in Cart Item
     */
    public function add_qty(Request $request)
    {
        $item = Cart::get($request->rowId);
        $row = Cart::update($request->rowId, $item->qty + 1);
        $total = $row->price * $row->qty;
        return response(['success', 'totalCost' => number_format($total), 'qty' => $row->qty]);
    }


    /**
     * Subtracting Quantity in cart
     */
    public function sub_qty(Request $request)
    {
        $item = Cart::get($request->rowId);
        $row = Cart::update($request->rowId, $item->qty - 1);
        $total = $row->price * $row->qty;
        return response(['success', 'totalCost' => number_format($total), 'qty' => $row->qty]);
    }


    /**
     * Removing item from cart
     * @param string $rowId
     */
    public function remove_from_cart($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }


    /**
     * Showing Checkout page
     */
    public function checkout()
    {
        if (Cart::count() == 0) {
            return redirect()->route('cart.index');
        }
        $cart = Cart::content();
        $totalAmount = self::totalAmount(Cart::total());
        return view('front.checkout', compact(['cart', 'totalAmount']));
    }

    /**
     * Calculates the total amount with delivery charge.
     * @param string $amount
     * @return string
     */
    public static function totalAmount(string $amount): string
    {
        $cleanedValue = str_replace(',', '', $amount);
        $integerValue = (int) $cleanedValue;

        $integerValue += 100; // This is delivery Charge

        $formattedValue = number_format($integerValue);

        return $formattedValue;
    }
}
