<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(IsAdmin::class);
    }

    public function index()
    {
        $data = Subcategory::leftJoin('categories', 'subcategories.category_id', '=', 'categories.id')
            ->select('subcategories.*', 'categories.category_name')
            ->get();
        $category = Category::get();
        return view('admin.category.subcategory.index', compact('data', 'category'));
    }

    // store method
    public function store(Request $request)
    {
        $validated = $request->validate(([
            'subcategory_name' => 'required|max:55',
        ]));
        $data = [];
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        $data['subcat_slug'] = Str::slug($request->subcategory_name, '-');
        $subcategory = Subcategory::create($data);
        if ($subcategory) {
            return redirect()->back()->with('notyf', ['type' => 'success', 'message' => 'Sub Category Inserted']);
        } else {
            return redirect()->back()->with('notyf', ['type' => 'error', 'message' => 'Sub Category Inserted Inserted fail']);
        }
    }

    public function destroy(string $id)
    {
        $subcat = Subcategory::find($id);
        if ($subcat) {
            $subcat->delete();
            return redirect()->route('subcategory.index')->with('notyf',['type'=>'success','message'=>'Category deleted successfully.']);
        }else{
            return redirect()->route('subcategory.index')->with('notyf',['type'=>'error','message'=>'Category not found.']);
    }

}

public function edit(string $id){
 $data = Subcategory::find($id);
 $category = Category::get();
 return view('admin.category.subcategory.edit',compact('data','category'));
}

public function update(Request $request,string $id){

    $request->validate([
        'subcategory_name'=>'required|max:55',
    ]);

    // $data['subcategory_name'] = $request->subcategory_name;
    // $data['subcat_slug'] = Str::slug($request->subcategory_name, '-');
    // $data['category_id'] = $request->category_id;

    $subcategory = Subcategory::where('id', $id)->update([
        'subcategory_name'=>$request->subcategory_name,
        'subcat_slug'=>Str::slug($request->subcategory_name, '-'),
        'category_id'=>$request->category_id,
    ]);
    if($subcategory){
       return redirect()->route('subcategory.index')->with('notyf',['type'=>'success','message'=>'Sub Category Updated']);
    }
}



}