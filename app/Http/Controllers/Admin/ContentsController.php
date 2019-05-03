<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\Contents;
use Image;
use Session;

class ContentsController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(){
        $contents = Contents::get();
        foreach ($contents as $value) {
            $this->data[$value->name] = $value->value;
        }
        return $this->render_view('pages.preferences.settings.contents.index');
    }

    public function addContents(request $request){
        foreach ($request->except(['_token']) as $value => $key) {
            $contents = Contents::where('name', $value)->first();
            if($request->file($value)){
                $this->validate($request,['home_header' => 'image|mimes:jpeg,png,jpg,gif,svg,tif|max:2048|dimensions:min_width=1200,max_width=1200,min_height=450,max_height=450']);
                $this->validate($request,['contact_us_header' => 'image|mimes:jpeg,png,jpg,gif,svg,tif|max:2048|dimensions:min_width=1200,max_width=1200,min_height=450,max_height=450']);
                $this->validate($request,['gallery_header' => 'image|mimes:jpeg,png,jpg,gif,svg,tif|max:2048|dimensions:min_width=1200,max_width=1200,min_height=450,max_height=450']);
                $this->validate($request,['footer_background' => 'image|mimes:jpeg,png,jpg,gif,svg,tif|max:2048|dimensions:min_width=1200,max_width=1263,min_height=169,max_height=169']);
                $img = Image::make($key);
                $key = str_random(5).'.'.explode('/',$img->mime)[1];
                $img->save('images/frontend/contents/'.$key);
            }
            if(!$contents){
                $contents = new Contents;
                $contents->name = $value;
            }
            $contents->value = $key;
            $contents->save();
        }
        $request->session()->flash('message', 'Data Successfully Submited!');
        return redirect()->back();
    }
}
