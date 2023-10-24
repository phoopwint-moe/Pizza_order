<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //direct contact page
    public function page(){
        return view('user.contact');
    }

    //send message
    public function message(Request $request){
        $this->Val($request);
        $message = $this->getData($request);
        Contact::create($message);

        return back()->with(['send' => 'Message Send Successfully!']);
    }

    //direct contact list page
    public function list(){
        $datas = Contact::get();
        return view('admin.contact.contact', compact('datas'));
    }

    //delete message
    public function delete($id){
        Contact::where('id', $id)->delete();
        return back()->with(['success' => 'Message Deleted Successfully!']);
    }
    //getData
    private function getData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
    }

    //Validation
    private function Val($request){
        $rule = [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ];
        Validator::make($request->all(), $rule)->validate();
    }
}
