<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderGroup;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        $orderGroup =  OrderGroup::latest()
            ->withCount('order')
            ->with('order.product')
            ->paginate(10);

        return view('admin.order.all', compact('orderGroup'));
    }

    public function changeOrderStatus($id)
    {
        OrderGroup::where('id', $id)->update([
            'status' => request()->status
        ]);
        return redirect('/admin/order')->with('success', 'Status Changed');
    }
}
