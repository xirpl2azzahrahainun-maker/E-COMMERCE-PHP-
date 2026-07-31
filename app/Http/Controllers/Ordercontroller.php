<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartitem = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartitem->isEmpty()) {
            return redirect()
                ->route('customer.productcus')
                ->with('error', 'Your cart is empty');
        }

        $total = $cartitem->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('customer.checkout', compact('cartitem', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'shipping_name'    => 'required|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'shipping_phone'   => 'required|string|max:20',
            'payment_method'   => 'required|in:COD,e-wallet,bank_transfer',
        ]);

        $cartitem = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartitem->isEmpty()) {
            return redirect()
                ->route('customer.productcus')
                ->with('error', 'Your cart is empty');
        }

        $total = $cartitem->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id'          => Auth::id(),
                'order_number'     => 'ORD-' .time() . '-' . Auth::id(),
                'total_amount'     => $total,
                'status'           => 'pending',
                'shipping_name'    => $request->shipping_name,
                'shipping_address' => $request->shipping_address,
                'shipping_phone'   => $request->shipping_phone,
                'payment_method'   => $request->payment_method,
                'payment_status'   => 'unpaid',
            ]);

            foreach ($cartitem as $item) {
                $orderItem = $order->orderItems()->create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);
                $product = $item->product;
                $product ->stock -= $item->quantity;
                $product->save();
            }
            Cart ::where('user_id', Auth::id())->delete();
            DB::commit();
return redirect()->route('customer.order.confirmation', $order->id);

        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.checkout')->with('error', 'Failed to process order: ' . $e->getMessage());
        }
    }

    public function Konfirmasi($orderId){
        $order = Order::where('id', $orderId)->where('user_id', Auth::id())->with('orderItems.product')->firstOrFail();
return view('customer.confirmation', compact('order'));
    }

    public function orders(){
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        return view('customer.orders', compact('orders'));
    }

    public function orderDetails($orderId){
        $order = Order::where('id', $orderId)->where('user_id', Auth::id())->with('orderItems.product')->firstOrFail();
        return view('customer.details', compact('order'));
    }
}
