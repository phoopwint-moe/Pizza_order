<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct home
    public function home(){
        $pizzas = Product::orderBy('created_at', 'desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.home', compact('pizzas', 'categories', 'cart', 'history'));
    }

    //direct info page
    public function info(){
        return view('user.account.info');
    }

    //direct edit page
    public function edit(){
        return view('user.account.edit');
    }

    //acc update
    public function update($id, Request $request){
        $this->updateValCheck($request);
        $data = $this->getData($request);
        
        //for img
        if($request->hasFile('img')){
            //delete oldimg
            $oldImg = User::where('id',$id)->first();
            $oldImg = $oldImg->img;
            if($oldImg !== null){
                Storage::delete('public/' .$oldImg);
            }

            //update img
            $imgName = uniqid().$request->file('img')->getClientOriginalName();
            $request->file('img')->storeAs('public', $imgName);
            $data['img'] = $imgName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('useracc#info')->with(['update' => 'Account Updated!']);
    }

    //direct password change page
    public function changePage(){
        return view('user.account.change');
    }

    //change password
    public function changePassword(Request $request){
        //validation
        $this->passwordValCheck($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbpassword = $user->password;

        if(Hash::check($request->oldPassword, $dbpassword)){
        $data = [
            'password' => Hash::make($request->newPassword)
        ];
        User::where('id',Auth::user()->id)->update($data);
        
        Auth::logout();

        return redirect()->route('auth#loginPage')->with(['changeSuccess' => 'Password changed successfully! please Singin again...']);
        }
        return back()->with(['notMatch' => 'Password incorrect']);
    }
    
    //filter product by Category
    public function filter($catId){
        $pizzas = Product::where('category_id', $catId)->orderBy('created_at', 'desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.home', compact('pizzas', 'categories','cart', 'history'));
    }

    //direct product detail page
    public function detail($id){
        $pizza = Product::where('id', $id)->first();
        $pizzaAll = Product::get();
        return view('user.detail', compact('pizza' , 'pizzaAll'));
    }

    //direct order page
    public function order(){
        $datas = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('user.order', compact('datas'));
    }
    
    //direct order detail page
    public function Orderdetail($orderCode){
        $order = OrderList::select('order_lists.*', 'users.name as userName', 'products.name as productName', 'products.img as productImg', 'products.price as productPrice')
                            ->leftJoin('users', 'users.id', 'order_lists.user_id')
                            ->leftJoin('products', 'products.id', 'order_lists.product_id')
                            ->where('order_code', $orderCode)
                            ->get();
        $orderInfo = Order::where('order_code', $orderCode)->first();
        return view('user.orderDetail', compact('order', 'orderInfo'));
    }
    //get data 
    private function getData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender
        ];

    }

    //acc update validation
    private function updateValCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'img' => 'mimes:png,jpg,jpeg'
        ])->validate();
    }

    //password Validation
    private function passwordValCheck($request){
        Validator::make($request->all(),[
        'oldPassword' => 'required|min:6',
        'newPassword' => 'required|min:6',
        'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }
}
