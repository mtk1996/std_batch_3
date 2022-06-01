<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderGroup;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart($slug)
    {
        $checkProduct = Product::where('slug', $slug)->first();
        if (!$checkProduct) {
            return redirect('/')->with('error', 'Product Not Found');
        }

        $checkInCart = Cart::where('user_id', auth()->id())->where('product_id', $checkProduct->id)
            ->first();
        if (!$checkInCart) {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $checkProduct->id,
                'total_quantity' => 1
            ]);
        } else {
            $checkInCart->update([
                'total_quantity' => DB::raw('total_quantity+1'),
            ]);
        }

        return redirect()->back()->with('success', 'Added To Cart');
    }

    public function showCart()
    {
        $cart = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        return view('cart', compact('cart'));
    }

    public function removeCart($id)
    {
        Cart::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Remove Product From Cart');
    }

    public function checkOut()
    {
        //order store
        $orderGroup =   OrderGroup::create([
            'user_id' => auth()->id(),
            'order_date' => date('Y-m-d'),
        ]);

        $cart = Cart::where('user_id', auth()->id());
        foreach ($cart->get() as $c) {
            Order::create([
                'order_group_id' => $orderGroup->id,
                'user_id' => auth()->id(),
                'product_id' => $c->product_id,
                'total_quantity' => $c->total_quantity,
            ]);
        }
        //cart clear
        $cart->delete();
        return redirect('/')->with('success', 'Check Out Succes Please Wait');
    }
}
