<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{   
    //direct dashboard
    public function dashboard(){
        $acc = User::get();
        $order = Order::get();
        $product = Product::get();
        $message = Contact::get();
        return view('admin.dashboard', compact('acc', 'order', 'product', 'message'));
    }
    //direct change password page
    public function changePasswordPage(){
        return view('admin.account.change');
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

    //direct acc info page
    public function info(){
        return view('admin.account.accinfo');
    }
    
    //direct acc edit page
    public function edit(){
        return view('admin.account.edit');
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
        return redirect()->route('acc#info')->with(['update' => 'Account Updated!']);
    }
    
    //Direct adminList
    public function list(){
        $datas = User::when(request('key'), function($query){
                            $query->orWhere('name','like', '%' .request('key'). '%')
                                    ->orWhere('gender','like', '%' .request('key'). '%')
                                    ->orWhere('phone','like', '%' .request('key'). '%');
                        })->where('role', 'admin')->paginate(5);
        return view('admin.account.adminList', compact('datas'));
    }

    //delete admin
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['delete' => 'Admin Deleted!']);
    }

    //change admin role
    public function changeRole(Request $request){
        User::where('id', $request->id)->update([
            'role' => $request->status
        ]);

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
