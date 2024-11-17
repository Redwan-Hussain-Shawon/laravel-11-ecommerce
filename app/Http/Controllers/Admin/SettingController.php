<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use App\Models\Seo;
use App\Models\Smtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(IsAdmin::class);
    }
    public function seo()
    {
        $data = Seo::first();
        return view('admin.setting.seo', compact('data'));
    }
    public function seoUpdate(Request $request)
    {
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

        if ($seo) {
            return redirect()->back()->with('notyf', ['type' => 'success', 'message' => 'Seo Setting Updated']);
        }
    }

    public function smtp()
    {
        $data = Smtp::get()->first();
        return view('admin.setting.smtp', compact('data'));
    }
    public function smtpUpdate(Request $request)
    {
        $id = $request->id;
        $data = array();
        $data['mailer'] = $request->mailer;
        $data['host'] = $request->host;
        $data['port'] = $request->port;
        $data['user_name'] = $request->user_name;
        $data['password'] = $request->password;

        $smtp = Smtp::find($id)->update($data);
        if ($smtp) {
            return redirect()->back()->with('notyf', ['type' => 'success', 'message' => 'Smtp Setting Updated']);
        }
    }

    public function website()
    {
        $setting = DB::table('settings')->first();
        return view('admin.setting.website_setting', compact('setting'));
    }

    public function websiteUpdate(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data['currency'] = $request->currency;
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['main_email'] = $request->main_email;
        $data['support_email'] = $request->support_email;
        $data['address'] = $request->address;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['instagram'] = $request->instagram;
        $data['linkedin'] = $request->linkedin;
        $data['youtube'] = $request->youtube;
        
        if($request->logo){
            if(file_exists($request->old_logo)){
                unlink($request->old_logo);
            }
            $logo = $request->file('logo');
            $logoname = uniqid().'_innovativeitsoft.'.$logo->getClientOriginalExtension();
            Image::make($logo)->resize(320,120)->save('public/file/setting/'.$logoname);
            $data['logo']='public/file/setting/'.$logoname;
        }else{
            $data['logo']= $request->old_logo;
        }

        if($request->favicon){
            if(file_exists($request->old_favicon)){
                unlink($request->old_favicon);
            }
            $favicon = $request->file('favicon');
            $faviconname = uniqid().'.' .$favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(32,32)->save('public/file/setting/'.$faviconname);
            $data['favicon']= 'public/file/setting/'.$faviconname;
        }else{
            $data['favicon'] = $request->old_favicon;
        }
        $setting = DB::table('settings')->where('id',$id)->update($data);
        if($setting){
            return redirect()->back()->with('notyf', ['type' => 'success', 'message' => 'Website Setting Updated']);
        }
    }
}
