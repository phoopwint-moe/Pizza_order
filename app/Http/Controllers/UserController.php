<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //direct userList page
    public function listPage(){
        $datas = User::where('role', 'user')->paginate(5);
        return view('admin.account.user', compact('datas'));
    }

    //change user role
    //change admin role
    public function changeRole(Request $request){
        User::where('id', $request->id)->update([
            'role' => $request->status
        ]);
        return back()->with(['change' => 'User role Change!']);
    }

    //delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['delete' => 'User Deleted!']);
    }
}
