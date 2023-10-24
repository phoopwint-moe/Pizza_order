<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    //direct checkout
    public function checkout($orderCode){
        return view('user.checkout', compact('orderCode'));
    }

    //order 
    public function order($orderCode, Request $request){
        $this->orderVal($request);
         Order::where('order_code', $orderCode)->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'message' => $request->message
         ]);

         return redirect()->route('user#home')->with(['success' => 'order successfully!']);
    }

    //direct listPage
    public function listPage(){
        $order = Order::select('orders.*', 'users.name as userName')
                        ->leftJoin('users', 'users.id', 'orders.user_id')
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('admin.order.list', compact('order'));
    }

    //sort order
    public function sort(Request $request){
        $order = Order::select('orders.*', 'users.name as userName')
                        ->leftJoin('users', 'users.id', 'orders.user_id')
                        ->orderBy('created_at', 'desc');

        if($request->status == null){
            $order = $order->get();
        }else{
            $order = $order->where('orders.status', $request->status)->get();
        }

        return view('admin.order.list', compact('order'));
    }

    //change status
    public function change(Request $request){
        Order::where('id', $request->order)->update([
            'status' => $request->status
        ]);
        return back()->with(['delete' => 'User Deleted!']);
    }

    //direct detail page
    public function detail($orderCode){
        $order = OrderList::select('order_lists.*', 'users.name as userName', 'products.name as productName', 'products.img as productImg', 'products.price as productPrice')
                            ->leftJoin('users', 'users.id', 'order_lists.user_id')
                            ->leftJoin('products', 'products.id', 'order_lists.product_id')
                            ->where('order_code', $orderCode)
                            ->get();
        $orderInfo = Order::where('order_code', $orderCode)->first();
        return view('admin.order.detail', compact('order', 'orderInfo'));
    }

    //order cancel
    public function cancel($id){
        Order::where('id', $id)->update([
            'status' => 3
        ]);

        return redirect()->route('user#order')->with(['cancel' => 'Order Cancel!']);
    }

    //order delete
    public function delete($orderCode){
        Order::where('order_code', $orderCode)->delete();
        OrderList::where('order_code', $orderCode)->delete();
        return back()->with(['delete' => 'Order Deleted Successfully!']);
    }
    //validation
    private function orderVal($request){
        Validator::make($request->all(), [
            'address' => 'required',
            'phone' => 'required|max:20',
            'message' => 'required'
        ])->validate();
    }
}

