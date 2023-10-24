<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function listPage(){
        $datas = Product::select('products.*', 'categories.name as category_name')
                    ->when(request('key'),function($query){
                    $query->orWhere('products.name','like', '%' .request('key'). '%')
                            ->orWhere('categories.name','like', '%' .request('key'). '%');
                    })
                    ->leftJoin('categories', 'products.category_id', 'categories.id')
                    ->paginate(5);
        return view('admin.product.list', compact('datas'));
    }

    //direct create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create', compact('categories'));
    }

    //create product
    public function create(Request $request){
        $this->productVal($request, 'create');
        $pizza = $this->getData($request);

        //add img
        $imgName = uniqid().$request->file('img')->getClientOriginalName();
        $request->file('img')->storeAs('public/' . $imgName);
        $pizza['img'] = $imgName;

        Product::create($pizza);
        return back()->with(['created' => 'Product created Successfully!']);
    }

    //delete product

    public function delete($id){
        Product::where('id', $id)->delete();    
        return back()->with(['delete' => 'Product Deleted Successfully!']);
    }

    //Product Detail Page
    public function detail($id){
        $data = Product::select('products.*', 'categories.name as category_name')
                        ->where('products.id', $id)
                        ->leftJoin('categories', 'products.category_id', 'categories.id')
                        ->first();
        return view('admin.product.detail', compact('data'));
    }

    //product edit page
    public function edit($id){
        $data = Product::where('id',$id)->first();
        $categories = Category::select('id','name')->get();
        return view('admin.product.edit', compact('data','categories'));
    }

    //product update
    public function update($id, Request $request){
        $this->productVal($request , 'update');
        $data = $this->getData($request);

        //for img 
        if($request->hasFile('img')){
            //delete oldimg
            $oldImg = Product::where('id',$id)->first();
            $oldImg = $oldImg->img;
            Storage::delete('public/' .$oldImg);
            

            //update img
            $imgName = uniqid().$request->file('img')->getClientOriginalName();
            $request->file('img')->storeAs('public', $imgName);
            $data['img'] = $imgName;
        }

        Product::where('id',$id)->update($data);
        return redirect()->route('product#detail', $id)->with(['update' => 'Product Updated Successfully!']);
    }
    //product Data Get
    private function getData($request){
        return [
            'name' => $request->name,
            'category_id' => $request->categoryId,
            'description' => $request->des,
            'price' => $request->price,
            'waiting_time' => $request->waitingTime
        ];
    }
    //product create validation
    private function productVal($request, $action){
        $validationRule = [
            'name' => 'required|unique:products,name,'. $request->id,
            'categoryId' => 'required',
            'des' => 'required',
            'price' => 'required',
            'waitingTime' => 'required'
        ];
        $validationRule['img'] = $action == 'create' ? 'required|mimes:png,jpg,jpeg|max:5000' : 'mimes:png,jpg,jpeg|max:5000';
        Validator::make($request->all(),$validationRule)->validate();
    }
}
