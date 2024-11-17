<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware(IsAdmin::class);
    }
    public function index()
    {
        $data = DB::table('pickup_points')->get();
        return view('admin.pickup_point.index', compact('data'));
    }
    public function store(Request $request)
    {
        $data = array();
        $data['pickup_point_name'] = $request->pickup_point_name;
        $data['pickup_point_phone'] = $request->pickup_point_phone;
        $data['pickup_point_phone_two'] = $request->pickup_point_phone_two;
        $data['pickup_point_address'] = $request->pickup_point_address;
        $pickup_point = DB::table('pickup_points')->insert($data);
        if ($pickup_point) {
            return redirect()->back()->with('notyf', ['type' => 'success', 'message' => 'Pickup Point Added successfully.']);
        } else {
            return redirect()->back()->with('notyf', ['type' => 'danger', 'message' => 'Something rong!']);
        }
    }
    public function destroy(string $id){
        $data = DB::table('pickup_points')->where('id',$id)->delete();
        if($data){
            return redirect()->back()->with('notyf',['type'=>'success','message'=>'Pickup Point deleted successfully.']);
        }
    }

    public function edit(string $id){
        $data = DB::table('pickup_points')->find($id);
        return view('admin.pickup_point.edit',compact('data'));
    }

    public function update(Request $request){
            $data = array();
            $id = $request->id;
            $data['pickup_point_name'] = $request->pickup_point_name;
            $data['pickup_point_phone'] = $request->pickup_point_phone;
            $data['pickup_point_phone_two'] = $request->pickup_point_phone_two;
            $data['pickup_point_address'] = $request->pickup_point_address;
            $pickup_point = DB::table('pickup_points')->where('id',$id)->update($data);
            if ($pickup_point) {
                return redirect()->back()->with('notyf', ['type' => 'success', 'message' => 'Pickup Point Updated successfully.']);
            } else {
                return redirect()->back()->with('notyf', ['type' => 'danger', 'message' => 'Something rong!']);
            }
    }
}
