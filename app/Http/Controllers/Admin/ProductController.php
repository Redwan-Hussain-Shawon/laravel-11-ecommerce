<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(IsAdmin::class);
    }
    
    public function index(Request $request){
       if($request->ajax()){
        $query = Product::with([
            'category:id,category_name',
            'subcategory:id,subcategory_name',
            'brand:id,brand_name'
        ])
        ->select('id', 'name', 'code', 'selling_price', 'thumbnail','category_id','subcategory_id','brand_id','featured','today_deal','status')
        ->latest();
     if ($request->cateogry_id) {
        $query->where('category_id', $request->cateogry_id);
    }
    
    if ($request->brand_id) {
        $query->where('brand_id', $request->brand_id);
    }  
    if ($request->warehouse_id) {
        $query->where('warehouse', $request->warehouse_id);
    } 
    if ($request->status !== null) {
        if ($request->status == 0) {
            $query->whereNull('status'); 
        } elseif ($request->status == 1) {
            $query->where('status', 1); 
        }
    }



        return DataTables::of($query)
        ->addColumn('thumbnail',function($row){
            return asset($row->thumbnail);
        })
         ->addColumn('category',function($row){
            return $row->category->category_name;
        })
        ->addColumn('brand',function($row){
            return $row->brand->brand_name;
        })
        ->addColumn('subcategory',function($row){
            return $row->subcategory->subcategory_name;
        })
        ->editColumn('action',function($row){
            return '<a href="/product/edit/' . $row->id . '" class="btn btn-sm btn-primary">Edit</a>
            <a href="/product/delete/' . $row->id . '" class="btn btn-sm btn-danger">Delete</a>';
        })
        ->editColumn('featured', function ($row) {
            if ($row->featured == 1) {
                return '<a href="#" data-id="' . $row->id . '" class="dactive_featured">
                        <i class="fa fa-thumbs-up text-success" aria-hidden="true"></i>
                        <span class="badge badge-success">active</span>
                    </a>';
            } else {
                return '<a href="#" data-id="' . $row->id . '" class="active_featured">
                        <i class="fa fa-thumbs-down text-danger" aria-hidden="true"></i>
                        <span class="badge badge-danger">inactive</span>
                    </a>';
            }
        })
        ->editColumn('today_deal', function ($row) {
            if ($row->today_deal == 1) {
                return '<a href="#">
                        <i class="fa fa-thumbs-up text-success" aria-hidden="true"></i>
                        <span class="badge badge-success">active</span>
                    </a>';
            } else {
                return '<a href="#">
                        <i class="fa fa-thumbs-down text-danger" aria-hidden="true"></i>
                        <span class="badge badge-danger">inactive</span>
                    </a>';
            }
        })
        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return '<a href="#">
                        <i class="fa fa-thumbs-up text-success" aria-hidden="true"></i>
                        <span class="badge badge-success">active</span>
                    </a>';
            } else {
                return '<a href="#">
                        <i class="fa fa-thumbs-down text-danger" aria-hidden="true"></i>
                        <span class="badge badge-danger">inactive</span>
                    </a>';
            }
        })
        ->addColumn('action', function ($row) {
            return '<a href="/product/edit/' . $row->id . '" class="btn btn-sm btn-primary">Edit</a>
                    <a href="'. route('product.delete',$row->id) . '" class="btn btn-sm btn-danger">Delete</a>';
        })
        ->rawColumns(['featured', 'today_deal', 'status', 'action', 'thumbnail']) // Mark these columns as raw HTML
        ->make(true);
       }
       $category = DB::table('categories')->get();
       $brand = DB::table('brands')->get();
       $warehouse = DB::table('warehouses')->get();
        return view('admin.product.index',compact('category','brand','warehouse'));
    }

    public function create(){
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $pickup_point = DB::table('pickup_points')->get();
        $warehouse = DB::table('warehouses')->get();

        return view('admin.product.create',compact('category','brand','pickup_point','warehouse'));
    }
    
  

    public function store(Request $request){
        $validated = $request->validate([
            'name'=>'required',
            'code'=>'required|unique:products|max:55',
            'subcategory_id'=>'required',
            'brand_id'=>'required',
            'unit'=>'required',
            'selling_price'=>'required'
        ]);
        $subcategory = DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data['name'] = $request->name;
        $data['slug']= Str::slug($request->name,'-');
        $data['code'] = $request->code;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['category_id'] = $subcategory->category_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['unit'] = $request->unit;
        $data['warehouse'] = $request->warehouse;
        $data['purchase_price'] = $request->purchase_price;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['tags'] = $request->tags;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['color'] = $request->color;
        $data['size'] = $request->size;
        $data['description'] = $request->description;
        // $data['video'] = $request->video;
        $data['admin_id'] = Auth::id();
        $data['featured'] = $request->featured;
        $data['today_deal'] = $request->today_deal;
        $data['status'] = $request->status;
        $slug= Str::slug($request->name,'-');
        // single thumbnail 
        if($request->thumbnail){
            $photo = $request->file('thumbnail');
            $photoname = $slug.'_'.rand(100,999).'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,600)->save('public/file/product/'.$photoname);
            $data['thumbnail'] = 'public/file/product/'.$photoname;
        }
        
        // multipart image
        $images = [];
        if($request->hasFile('images')){
            foreach($request->file('images') as $key => $image){
                $imageName = uniqid().'_'.time().'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(600,600)->save('public/file/product/other/'.$imageName);
                $images[]='public/file/product/other/'.$imageName;
            }
        }
        $data['images'] = json_encode($images);

        $product = Product::create($data);
        if($product){
            return redirect()->back()->with('notyf', ['type' => 'success', 'message' => 'Product Created Successfully']);
        }
    }

    public function dactiveFeatured(string $id){
        DB::table('products')->where('id',$id)->update(['featured'=>0]);
        // session()->flash('error', 'Product Not Featured');
        session()->flash('notyf',['type'=>'success','message'=>'Product Featured dactive']);
        return response()->json('Product Not Featured');
    }

    public function activeFeatured(string $id){
        DB::table('products')->where('id',$id)->update(['featured'=>1]);
        session()->flash('notyf',['type'=>'success','message'=>'Product Featured active']);
        return response()->json('Product Not Featured');
    }

    public function delete(string $id){
        $product = Product::destroy($id);
        return redirect()->back()->with('notyf',['type'=>'success','message'=>'Product Deleted Successfully']);
    }

}
