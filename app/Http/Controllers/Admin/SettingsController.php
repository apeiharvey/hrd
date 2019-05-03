<?php

namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\Settings;
use Image;
use Session;

class SettingsController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(){
        $settings = Settings::get();
        foreach ($settings as $value) {
            $this->data[$value->name] = $value->value;
        }
        if(auth()->user()->name){
            return $this->render_view('pages.preferences.settings.index');
        }
        else{
            return redirect('/sign-in');
        }
    	
    }

    public function addSettings(request $request){
    	foreach ($request->except(['_token']) as $value => $key) {
            $settings = Settings::where('name', $value)->first();
            if($request->file($value)){
                $this->validate($request,['logo_header' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=300,max_width=300,min_height=80,max_height=80']);
                $this->validate($request,['logo_footer' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=200,max_width=200,min_height=60,max_height=60']);
                $this->validate($request,['fav_icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=30,max_width=30,min_height=30,max_height=30']);
                $img = Image::make($key);
                $key = str_random(5).'.'.explode('/',$img->mime)[1];
                $img->save('images/frontend/web/'.$key);
            }
            if(!$settings){
                $settings = new Settings;
                $settings->name = $value;
            }
            $settings->value = strip_tags($key);
            $settings->save();
        }
        $request->session()->flash('message', 'Data Successfully Submited!');
        return redirect()->back();
    }

}