<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function listPage(){
        $datas = Category::when(request('key'),function($query){
                            $query->where('name', 'like', '%'. request('key') .'%');
                        })
                        ->orderBy('id', 'asc')->paginate(5);
        return view('admin.category.list',compact('datas'));
    }

    //direct cat category page
    public function createPage(){
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request){
        $this->catVal($request);
        $data = $this->catData($request);
        Category::create($data);
        return back()->with(['create' => 'Category created!']);
    }

    //delete category
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['delete' => 'Category deleted!']);
    }

    //direct edit
    public function edit($id){
        $data = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('data'));
    }
    //update category
    public function update($id, Request $request){
        $this->catVal($request);
        $data = $this->catData($request);
        Category::where('id',$id)->update($data);
        return redirect()->route('cat#list')->with(['update' => 'Category updated!']);
    }
    //category validation
    private function catVal($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'. $request->id
        ])->validate();
    }

    //get catData
    private function catData($request){
        return [
            'name' => $request->categoryName
        ];
    }
}
