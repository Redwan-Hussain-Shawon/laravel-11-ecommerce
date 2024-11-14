<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use App\Models\Seo;
use App\Models\Smtp;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(IsAdmin::class);
    }
    public function seo() {
        $data = Seo::first();
        return view('admin.setting.seo',compact('data'));
    }
    public function seoUpdate(Request $request){
        $id = $request->id;
        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_description'] = $request->meta_description;
        $data['meta_keyword'] = $request->meta_keyword;
        $data['google_verification'] = $request->google_verification;
        $data['alexa_verification'] = $request->alexa_verification;
        $data['google_analytics'] = $request->google_analytics;
        $data['google_adsense'] = $request->google_adsense;
        $seo = Seo::find($id)->update($data);

        if($seo){
            return redirect()->back()->with('notyf',['type'=>'success','message'=>'Seo Setting Updated']);
        }

    }

    public function smtp(){
        $data = Smtp::get()->first();
        return view('admin.setting.smtp',compact('data'));
    }
    public function smtpUpdate(Request $request){
        $id = $request->id;
        $data = array();
        $data['mailer']= $request->mailer;
        $data['host']= $request->host;
        $data['port']= $request->port;
        $data['user_name']= $request->user_name;
        $data['password']= $request->password;

        $smtp = Smtp::find($id)->update($data);
        if($smtp){
            return redirect()->back()->with('notyf',['type'=>'success','message'=>'Smtp Setting Updated']);
        }
    }
}
