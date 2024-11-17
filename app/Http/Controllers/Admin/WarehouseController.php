<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware(IsAdmin::class);
    }

    public function index(){
        $data = DB::table('warehouses')->latest()->get();
        return view('admin.category.warehouse.index',compact('data'));
    }
    public function store(Request $request){
        $data = [];
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_phone'] = $request->warehouse_phone;
        $data['warehouse_address'] = $request->warehouse_address ;
        $warehouse = DB::table('warehouses')->insert($data);
        if($warehouse){
            session()->flash('notyf',['type'=>'success','message'=>'website Warehouse Created']);
            return response()->json([
                'status'=>true,
                'message'=>'your data insert sussfully'
            ],200);
        }
       
    }

    public function destroy(string $id){
        $data = DB::table('warehouses')->where('id',$id)->delete();
        if($data){
            return response()->json([
                'status'=>true
            ],200);
        }
    }
    public function edit(string $id){
        $data = DB::table('warehouses')->find($id);
        return view('admin.category.warehouse.edit',compact('data'));
    }
    public function update(Request $request){
        $id = $request->id;
        $data= [];
        $data['warehouse_name']= $request->warehouse_name;
        $data['warehouse_phone']= $request->warehouse_phone;
        $data['warehouse_address']= $request->warehouse_address;
        $warehouse = DB::table('warehouses')->where('id',$id)->update($data);
        if($warehouse){
            return redirect()->route('warehouse.index')->with('notyf',['type'=>'success','message'=>'Warehouse Updated']);
         }
    }
}
