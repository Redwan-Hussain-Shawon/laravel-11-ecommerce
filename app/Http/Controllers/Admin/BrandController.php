<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware(IsAdmin::class);
    }

    public function index(){
        $data = Brand::orderBy('id','desc')->get();
        return view('admin.category.brand.index',compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            'brand_name'=>'required|unique:brands|max:55',
        ]);
        $slug = Str::slug($request->brand_name,'-');
        $data=[];
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = $slug;
        
        if ($request->hasFile('brand_logo')) {
            // Get the file from the request
            $file = $request->file('brand_logo');
            $photoname =  $slug.'.'.$file->getClientOriginalExtension();
            // $file->move('public/file/brand/',$photoname);  // without image intervenction
            Image::make($file)->resize(240,120)->save('public/file/brand/'.$photoname);

            $data['brand_logo'] = 'public/file/brand/'.$photoname;
        }
       $brand= Brand::create($data);
       
       if($brand){
        return redirect()->back()->with('notyf', ['type' => 'success', 'message' => 'Brand has been inserted successfully']);
       }
    }

    public function destroy(string $id){
        $brand = Brand::find($id);
        $image = $brand->brand_logo;
        if(file_exists($image)){
            unlink($image);
        }
        if(Brand::destroy($id)){
            return redirect()->back()->with('notyf',['type'=>'success','message'=>'Brand deleted successfully.']);
        }else{
         return redirect()->back()->with('notyf',['type'=>'error','message'=>'Brand not found.']);
        }
    }

    public function edit(string $id){
        $data = Brand::find($id);
        return view('admin.category.brand.edit',compact('data'));
    }
    public function update(Request $request){
        
        $slug = Str::slug($request->brand_name,'-');
        $data = [];
        $data['brand_name']= $request->brand_name;
        $data['brand_slug']= $slug;
        if($request->brand_logo){
            if(file_exists($request->old_brand_logo)){
                unlink($request->old_brand_logo);
            }
            $file = $request->file('brand_logo');
            $photoname = $slug .'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(240,120)->save('public/file/brand/'.$photoname);
            $data['brand_logo']='public/file/brand/'.$photoname;
            $brand = Brand::where('id',$request->id)->update($data);
            if($brand){
                return redirect()->back()->with('notyf',['type'=>'success','message'=>'Brand  Updated']);
            }
        }else{
            $data['brand_logo']=$request->old_brand_logo;
            $brand = Brand::where('id',$request->id)->update($data);
            if($brand){
                return redirect()->back()->with('notyf',['type'=>'success','message'=>'Brand  Updated']);
            }
        }
        
    }

}
