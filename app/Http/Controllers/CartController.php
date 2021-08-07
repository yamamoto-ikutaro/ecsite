<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cart;
use App\Item;

class CartController extends Controller
{
    public function cartIndex()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
        header("Pragma: no-cache");

        $data = [];
        $user = \Auth::user();
        $cart_items = $user->cart()->orderBy('created_at', 'desc')->get()->unique();
        $outOfStocks = $cart_items->where('item_quantity', 0)->pluck('id');
        $cart_item_dels = $user->del_item($outOfStocks);
        
        $totalPrice = 0;
        foreach($cart_items as $cart_item){
            $totalPrice += $cart_item->price * $cart_item->pivot->quantity;
        }
        
        if($cart_item_dels){
            $totalPrice = 0;
            foreach($cart_item_dels as $cart_item_del){
                $totalPrice += $cart_item_del->price * $cart_item_del->pivot->quantity;
            }
        }
        
        $data = ['user'=>$user, 'cart_items'=>$cart_items, 'totalPrice'=>$totalPrice];
        
        return view('cart.cart', $data);
    }
    
    public function store($id)
    {
        // dd($id);
        $user = \Auth::user();
        $cart_items = $user->cart;
        if($cart_items->where('item_id', $id)->first()){
            return back();
        }
        
        $itemPrice = Item::find($id)->price;
        
        $user->add_cart($id, $itemPrice);
        
        return redirect('cart');
    }
    
    public function destroy($id)
    {
        \Auth::user()->del_item($id);
        return back();
    }
    
    public function update(Request $request, $id){
        $itemQuantity = Item::find($id)->item_quantity;
        $request->validate([
            'quantity' => "integer|max:{$itemQuantity}",
        ]);
        $cart = Cart::where('user_id', \Auth::id())->where('item_id', $id)->first();
        if($cart && $request->quantity > 0 && $request->quantity){
            $cart->update([
                'quantity' => $request->quantity,
            ]);

        }
        return back();
    }
    
}