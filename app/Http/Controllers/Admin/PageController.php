<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(IsAdmin::class);
    }

    public function index(){
        $page = Page::get();
        return view('admin.setting.page.index',compact('page'));
    }

    public function store(Request $request){
        $data = [];
        $data['page_positon'] = $request->page_positon;
        $data['page_name'] = $request->page_name;
        $data['page_title'] = $request->page_title;
        $data['page_description'] = $request->page_description;
        $data['page_slug'] = Str::slug($request->page_title,'-');
        $pageCreate = Page::create($data);
        if($pageCreate){
            return redirect()->route('page.index')->with('notyf', ['type' => 'success', 'message' => 'Page Created']);
        } else {
            return redirect()->back()->with('notyf', ['type' => 'error', 'message' => 'Sub Category Inserted Inserted fail']);
        }
    }

    public function destroy(string $id){
        $page = Page::destroy($id);
        if($page){
            return redirect()->back()->with('notyf', ['type' => 'success', 'message' => 'Page Deleted Sussfully']);
        } else {
            return redirect()->back()->with('notyf', ['type' => 'error', 'message' => 'Page Delted Faild']);
        }
    }

    public function edit(string $id){
        $data = Page::find($id);
        return view('admin.setting.page.edit',compact('data'));
    }

    public function update(Request $request, string $id){
        $data = [];
        $data['page_positon'] = $request->page_positon;
        $data['page_name'] = $request->page_name;
        $data['page_title'] = $request->page_title;
        $data['page_description'] = $request->page_description;
        $data['page_slug'] = Str::slug($request->page_title,'-');
        $page = Page::find($id)->update($data);
        if($page){
            return redirect()->route('page.index')->with('notyf', ['type' => 'success', 'message' => 'Page Updated Sussfully']);
        } else {
            return redirect()->back()->with('notyf', ['type' => 'error', 'message' => 'Page Update Faild']);
        }
    }
    
    
}
