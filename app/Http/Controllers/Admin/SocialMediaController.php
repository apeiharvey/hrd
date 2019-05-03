<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\DB;
use Image;
use Session;

class SocialMediaController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['socialmedia'] = new SocialMedia;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['name','url','order','active']) ? $sort : 'order';
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
        if($request->has('search')){
            $this->data['socialmedia'] = SocialMedia::where('name','like','%'.$request->search.'%')
                                                     ->orderBy($sort,$order)
                                                     ->paginate(10);
        }
        else{
            $this->data['socialmedia'] = SocialMedia::orderBy($sort,$order)
                                                    ->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.social-media.index');
    }

    public function create(){
        return $this->render_view('pages.preferences.settings.social-media.insert');
    }

    public function store(request $request){
        $socialmedia = new SocialMedia;
        $socialmedia->name = $request->name;
        $socialmedia->url = $request->url;
        $socialmedia->order = $request->order;
        $socialmedia->active = $request->active;
        $socialmedia->created_by = auth()->user()->id;
        if($request->hasFile('thumbnail')){
            $this->validate($request,['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=24,max_width=24,min_height=24,max_height=24']);
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/social-media/'.$key);
    		$socialmedia->thumbnail = $key;
        }
        if($socialmedia->name && $socialmedia->url && $socialmedia->order && $socialmedia->created_by && $socialmedia->thumbnail){
            $socialmedia->save();
            $request->session()->flash('message', 'Data Successfully Submited!');
            return redirect()->back();
        }
        else{
            $request->session()->flash('message_failed', 'All Data Must be Filled!');
            return redirect()->back();
        }
        
    }


    public function show($id)
    {   
        $this->data['socialmedia'] = SocialMedia::find($id);
        return $this->render_view('pages.preferences.settings.social-media.update');
    }

    public function update(request $request, $id){
    	$this->data['socialmedia'] = SocialMedia::find($id);
        if($request->hasFile('thumbnail')){
            $this->validate($request,['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=24,max_width=24,min_height=24,max_height=24']);
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/social-media/'.$key);
    		$this->data['socialmedia']->thumbnail = $key;
        }
        $this->data['socialmedia']->name = $request->name;
        $this->data['socialmedia']->url = $request->url;
        $this->data['socialmedia']->order = $request->order;
        $this->data['socialmedia']->created_by = $request->created_by;
        $this->data['socialmedia']->updated_by = auth()->user()->id;
        $this->data['socialmedia']->active = $request->active;
        $this->data['socialmedia']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
            
    	return redirect()->back();
    }

    public function destroy(request $request, $id){
        $socialmedia = SocialMedia::find($id);
        $socialmedia->delete();
        $request->session()->flash('message_delete', 'Data Successfully Deleted!');
        return redirect()->back();

    }

    public function sorting(){
        $this->data['socialmedia'] = DB::table('social_media')
                ->orderBy('order', 'asc')
                ->get();
        return $this->render_view('pages.preferences.settings.social-media.sorting');
    }
    
    public function doSorting(request $request){
        $this->data['socialmedia'] = SocialMedia::get();
        $i=0;
        foreach ($request->id as $key) {
            $i++;
            DB::table('social_media')
            ->where('id', $key)
            ->update(['order' => $i]);
        }
        $request->session()->flash('message', 'Data Successfully Sorted!');
        return redirect()->back();
    }
}
