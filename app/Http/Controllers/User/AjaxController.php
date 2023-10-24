<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function pizza(Request $request){
        if($request->status == 'asc'){
            $pizza = Product::orderBy('created_at', 'asc')->get();
        }else{
            $pizza = Product::orderBy('created_at', 'desc')->get();
        }
        return $pizza;
    }

    //return addToCart
    public function addToCart(Request $request){
        $data = $this->getData($request);
        Cart::create($data);

        $response = [
            'message' => 'Add to Cart successfully',
            'status' => 'success'
        ];

        return response()->json($response, 200);
    }

    //order product
    public function order(Request $request){
        $total = 0;
        foreach($request->all() as $item){
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total_price' => $item['total_price'],
                'order_code' => $item['order_code']
            ]);

            $total += $data->total_price;
            Cart::where('user_id', $data->user_id)->delete();

        }

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000
        ]);
       

       return response()->json([
            'status' => 'true'
       ]);
    }   
     //increase viewcount
    public function viewCount(Request $request){
        $pizza = Product::where('id', $request->productId)->first();
        $viewCount = [
            'view_count' => $pizza->view_count +1
        ];
        Product::where('id', $request->productId)->update($viewCount);
    }

    //getData
    private function getData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->qty,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

   

}
