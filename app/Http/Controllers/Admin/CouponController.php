<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware(IsAdmin::class);
    }
    public function index(){
        $data = DB::table('coupons')->get();
        return view('admin.coupon.index',compact('data'));
    }

    public function store(Request $request){
        $data = [];
        $data['coupon_code']= $request->coupon_code;
        $data['type']= $request->type;
        $data['coupon_amount']= $request->coupon_amount;
        $data['valid_date']= $request->valid_date;
        $data['status']= $request->status;
        $coupon = DB::table('coupons')->insert($data);
        if($coupon){
            return redirect()->back()->with('notyf',['type'=>'success','message'=>'Coupon Added successfully.']);
        }else{
            return redirect()->back()->with('notyf',['type'=>'danger','message'=>'Something rong!']);
        }
    }
    public function destroy(string $id){
        $data = DB::table('coupons')->where('id',$id)->delete();
        if($data){
            return redirect()->back()->with('notyf',['type'=>'success','message'=>'Coupon deleted successfully.']);
        }
    }

    public function edit(string $id){
        $data = DB::table('coupons')->find($id);
        return view('admin.coupon.edit',compact('data'));
    }

    public function update(Request $request){
        $data = [];
        $id = $request->id;
        $data['coupon_code']= $request->coupon_code;
        $data['type']= $request->type;
        $data['coupon_amount']= $request->coupon_amount;
        $data['valid_date']= $request->valid_date;
        $data['status']= $request->status;
        $coupon = DB::table('coupons')->where('id',$id)->update($data);
        if($coupon){
            return redirect()->back()->with('notyf',['type'=>'success','message'=>'coupon Updated Sucessfully']);
        }
    }
}
