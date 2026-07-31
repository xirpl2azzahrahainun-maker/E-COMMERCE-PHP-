<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(){
        $Orders=Order::with('user')->orderBy('created_at','desc')->paginate(10);
        return view('Admin.Orders.index', compact('Orders'));
    }

    public function show($id){
        $order=Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('Admin.Orders.show', compact('order'));
    }

    public function Update( Request  $request ,$id){
        request()->validate([
            'status'=>'required|in:pending,processing,completed,canceled',
            'payment_status'=>'required|in: unpaid,paid',
        ]);

        $order=Order::findOrFail($id);
        $order->update([
            'status'=>$request->status,
            'payment_status'=>$request->payment_status,
        ]);
        return redirect()->route('Admin.Orders.show', ['id' => $id])->with(['success'=>'Order updated successfully']);
    }
}
