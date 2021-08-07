<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Item;
use App\Order;
use App\Purchase;
use App\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCompleteMail;

class OrderController extends Controller
{
    public function orderInfo()
    {
        $data = [];
        $user = \Auth::user();
        
        $cart_items = $user->cart()->orderBy('created_at', 'desc')->get();
        
        
        foreach($cart_items as $cart_item){
            if($cart_item->pivot->quantity > $cart_item->item_quantity){
                return back();
            }
        }
        $outOfStock = $cart_items->where('item_quantity', 0)->pluck('id');
        $user->del_item($outOfStock);
        
        $totalPrice = 0;
        foreach($cart_items as $cart_item){
            $totalPrice += $cart_item->price * $cart_item->pivot->quantity;
        }
        $cart = new Cart;
        $carts = Cart::where('user_id', $user->id)->get();
        $data = ['user'=>$user, 'cart_items'=>$cart_items, 'totalPrice'=>$totalPrice, 'carts'=>$carts];
        
        
        return view('order.order', $data);
        
    }
    
    public function order(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'postalCode' => 'required',
            'telephone' => 'required',
        ]);
        
        
        
        $user = \Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();
        $cart_items = $user->cart()->get();
        
        $outOfStock = $cart_items->where('item_quantity', 0)->pluck('id');
        $user->del_item($outOfStock);
        
        DB::beginTransaction();
        
        $purchase = $user->purchase()->create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'postalCode' => $request->postalCode,
            'telephone' => $request->telephone,
        ]);
        
        $cart_item_ids = [];
        foreach($carts as $cart){
            $cart_item_ids[] = $cart->item_id;
            
            $totalPrice = 0;
            $totalPrice += $cart->price * $cart->quantity;
            
            $purchase->orders()->create([
                'item_title' => Item::find($cart->item_id)->item_title,
                'quantity'   => $cart->quantity,
                'totalPrice' => $totalPrice,
            ]);

            $success = Item::where('id', $cart->item_id)->where('item_quantity', '>=' , $cart->quantity)->decrement('item_quantity', $cart->quantity);
            if(!$success){
                break;
            }
        }
        
        if($success){
            DB::commit();
        }
        
        else{
            DB::rollback();
            return redirect()->route('cart.index')->with('message', '購入できない商品がありました。');
        }
        
        $user->del_item($cart_item_ids);
        
        $orders = $purchase->orders;
        
        // $data = ['purchase'=>$purchase, 'orders'=>$orders];
        Mail::to($user->email)->send(new OrderCompleteMail($orders, $purchase));
        // gmailからメールを送信する場合は、gmailの二段階認証の設定とアプリパスワードの発行が必要
        return redirect('order_complete');
    }
    
    public function orderComplete()
    {
        return view('order.complete');
    }
    
    public function admin_orderInfo()
    {
        $purchases = Purchase::get();
        
        return view ('admin.admin_orderInfo', ['purchases'=>$purchases]);
    }
}
