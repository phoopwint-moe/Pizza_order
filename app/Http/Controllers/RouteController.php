<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //creare
    public function categoryCreate(Request $request){

        $data = $this->getData($request);
        
        $result = Category::create($data);

        return response()->json($result, 200);

    }
    
    //delete
    public function delete($id){
        $data = Category::where('id', $id)->first();

        if(isset($data)){
            Category::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'deleted sucessfully!'], 200);
        }

        return response()->json(['status' => false, 'message' => 'There is no category!'], 200);
    }

    //read
    public function list($id){
        $data = Category::where('id', $id)->first();

        if(isset($data)){
            return response()->json(['status' => true, 'category' => $data], 200);
        }

        return response()->json(['status' => false, 'message' => 'There is no category!'], 500);
    }

    //update
    public function categoryUpdate(Request $request){
        $id = $request->id;
        
        $check = Category::where('id', $id)->first();

        if(isset($check)){
            $data = $this->getData($request);
            Category::where('id', $id)->update($data);
            $result = Category::where('id', $id)->first();
            return response()->json(['status' => true, 'message' => 'category update successfully!', 'category' => $result], 200);
        }

        return response()->json(['status' => false, 'message' => 'There is no category to update!'], 500);
    }

    //get data
    private function getData($request){
        return [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
