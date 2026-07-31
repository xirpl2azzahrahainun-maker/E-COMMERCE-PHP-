<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $cartitem = Cart::where('user_id',Auth::id())
        ->with('product')
        ->get();

        $total = $cartitem->sum(function($item){
            return $item->product->price * $item->quantity;

        }
        );
        return view ('customer.cart',compact('cartitem','total'));
    }

    public function Add(Request $request,$productId){
        $product = Product ::findOrFail($productId);

    $cartitem = Cart::where('user_id', Auth::id())
        ->where('product_id', $productId)
        ->first();

        if($cartitem){
            $cartitem->quantity += $request->input('quantity',1);
            $cartitem->save();

        }else{
            Cart::create([
                   'user_id'=>Auth::id(),
                   'product_id'=> $productId,
                   'quantity'=> $request->input('quantity',1)
            ]);

        }
            return redirect()->back()->with('succes','Product added to cart');

    }
    public function update(Request $request,$cartId){
        $cartitem = Cart::Where('id',  $cartId)
        ->where('user_id', Auth::id())
        ->firstOrFail();
        $cartitem->quantity = $request->input('quantity');
        $cartitem->save();
        return redirect()->back ()->with('succes','cart','Cart update');
    }

    public function remove($cartId){
        $cartitem = Cart::Where('id', $cartId)
        ->where('user_id',Auth::id())
        ->delete();

        return redirect()-> back ()->with ('succes','item removed form cart');
    }
}
