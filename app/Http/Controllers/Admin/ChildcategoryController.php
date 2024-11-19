<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ChildcategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(IsAdmin::class);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Childcategory::leftJoin('categories', 'childcategories.category_id', 'categories.id')
                ->leftJoin('subcategories', 'childcategories.subcategory_id', 'subcategories.id')
                ->select('categories.category_name', 'subcategories.subcategory_name', 'childcategories.*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="" data-toggle="modal" id="editChildCat" data-id="' . $row->id . '" data-target="#editModal"
                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i>
                        </a>
                      <a href="' . route('childcategory.delete', $row->id) . '" class="btn btn-danger btn-sm "
                        id="deleteBtn"><i class="fas fa-trash"></i>
                        </a>';
                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $category = Category::get();
        return view('admin.category.childcategory.index', compact('category'));
    }

    public function store(Request $request)
    {
        $catid = Subcategory::where('id', $request->subcategory_id)->first();
        $data = [];
        $data['category_id'] = $catid->category_id;
        $data['subcategory_id'] = $catid->id;
        $data['childcategory_name'] = $request->childcategory_name;
        $data['childcategory_slug'] = Str::slug($request->childcategory_name);
        $childCategory = Childcategory::create($data);
        if ($childCategory) {
            return redirect()->back()->with('notyf', ['type' => 'success', 'message' => 'Child Category Inserted']);
        } else {
            return redirect()->back()->with('notyf', ['type' => 'error', 'message' => 'Sub Category Inserted Inserted fail']);
        }
    }
    public function destroy(string $id)
    {
        $childCat = Childcategory::destroy($id);
        if ($childCat) {
            return redirect()->route('subcategory.index')->with('notyf', ['type' => 'success', 'message' => 'Child Category deleted successfully.']);
        } else {
            return redirect()->route('subcategory.index')->with('notyf', ['type' => 'error', 'message' => 'Child Category not found.']);
        }
    }
    public function edit(string $id)
    {
        $category = Category::get();
        $child_cat = Childcategory::find($id);
        return view('admin.category.childcategory.edit',compact('category','child_cat'));
    }

    public function update(Request $request,string $id){
        $sub_cat = Subcategory::find($request->subcategory_id);
        $data = [];
        $data['category_id'] = $sub_cat->category_id;
        $data['subcategory_id'] = $sub_cat->id;
        $data['childcategory_name'] = $request->childcategory_name;
        $data['childcategory_slug'] = Str::slug($request->childcategory_name);
        $child_cat = Childcategory::find($id)->update($data);
        if($child_cat){
            return redirect()->route('childcategory.index')->with('notyf',['type'=>'success','message'=>'Child Category Updated']);
        }else{
            return redirect()->route('childcategory.index')->with('notyf', ['type' => 'error', 'message' => 'Something Rong!']);
        }
    }

    public function getChildcategory(string $id){
        $childcategory = Childcategory::where('subcategory_id',$id)
                                        ->select('id','childcategory_name')
                                        ->get();
        return response()->json($childcategory);
    }
}
