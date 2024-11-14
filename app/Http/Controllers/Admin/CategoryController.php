<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware(IsAdmin::class);
    }

    public function index(){
        $data = Category::get();
        return view('admin.category.category.index',compact('data'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'category_name'=>'required|unique:categories|max:55'
        ]);

        $data['category_name']= $request->category_name;
        $data['category_slug']= Str::slug($request->category_name);
        $category = Category::create([
            'category_name'=>$data['category_name'],
            'category_slug'=>$data['category_slug'],
        ]);
        
        return redirect()->back()->with('notyf', ['type' => 'success', 'message' => 'Category Inserted']);
        
    }

  
    public function destroy(string $id){
       $category =  Category::find($id);
       if($category){
        $category->delete();
        return redirect()->route('category.index')->with('notyf',['type'=>'success','message'=>'Category deleted successfully.']);
       }else{
        return redirect()->route('category.index')->with('notyf',['type'=>'error','message'=>'Category not found.']);
       }
    }

    public function edit(string $id){
        $category = Category::findOrFail($id);
            return response()->json($category);
    }

    
    public function update(Request $req){
        $id = $req->category_id;
        $data['category_name']= $req->category_name;
        $data['category_slug']= Str::slug($req->category_name,'-');
        $category= Category::where('id',$id)->update($data);
        if ($category) {
            return redirect()->route('category.index')->with('notyf',['type'=>'success','message'=>'Category updated successfully']);
        } else {
            return redirect()->route('category.index')->with('notyf',['type'=>'error','message'=>'Category not found ']);
        }
    }
}

    
