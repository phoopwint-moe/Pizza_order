<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function listPage(){
        $datas = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.img')
                     ->leftJoin('products', 'carts.product_id', 'products.id')
                     ->where('user_id', Auth::user()->id)
                     ->get();
        $total_price = 0;
        foreach($datas as $data){
            $total_price += $data->pizza_price * $data->qty;
        }
        return view('user.cart', compact('datas', 'total_price'));
    }

    //delete cart
    public function delete($id){
        Cart::where('id' , $id)->delete();
        return back();
    }

    //delete all cart
    public function deleteAll(){
        Cart::where('user_id', Auth::user()->id)->delete();
        return back();
    }
}
