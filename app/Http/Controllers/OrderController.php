<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderGroup;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function all()
    {
        $group = OrderGroup::where('user_id', auth()->id())
            ->latest()
            ->with('order.product')
            ->get();


        return view('order', compact('group'));
    }

    public function orderDetail($id)
    {
        $order = Order::where('order_group_id', $id)
            ->with('product')
            ->get();

        return view('order-detail', compact('order'));
    }
}
