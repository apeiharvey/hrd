<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Image;
use Session;

class GalleryController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['gallery'] = new Gallery;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['title','created_at','active']) ? $sort : 'created_at';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';
        if($request->has('search')){
            $this->data['gallery'] = Gallery::where('title','like','%'.$request->search.'%')
                                             ->orderBy($sort,$order)
                                             ->paginate(10);
        }
        else{
            $this->data['gallery'] = Gallery::orderBy($sort,$order)
                                            ->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.gallery.index');
    }

    public function create(){
        return $this->render_view('pages.preferences.settings.gallery.insert');
    }

    public function store(request $request){
        $gallery = new Gallery;
        $gallery->title = $request->title;
        $gallery->active = $request->active;
        $gallery->order = $request->order;
        $gallery->created_by = auth()->user()->id;
        if($request->hasFile('thumbnail')){
            $this->validate($request,['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=300,max_width=300,min_height=300,max_height=300']);
            $img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/gallery/'.$key);
            $gallery->thumbnail = $key;
        }
        if($gallery->title && $gallery->order && $gallery->created_by && $gallery->thumbnail){
            $gallery->save();
            $request->session()->flash('message', 'Data Successfully Submited!');
            return redirect()->back();
        }
        else{
            $request->session()->flash('message_failed', 'All Data Must Be Filled!');
            return redirect()->back();
        }
    }

    public function show($id)
    {   
        $this->data['gallery'] = Gallery::find($id);
        return $this->render_view('pages.preferences.settings.gallery.update');
    }

    public function update(request $request, $id){
    	$this->data['gallery'] = Gallery::find($id);
        if($request->hasFile('thumbnail')){
            $this->validate($request,['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=300,max_width=300,min_height=300,max_height=300']);
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/gallery/'.$key);
    		$this->data['gallery']->thumbnail = $key;
        }
        $this->data['gallery']->title = $request->title;
        $this->data['gallery']->order = $request->order;
        $this->data['gallery']->created_by = $request->created_by;
        $this->data['gallery']->updated_by = auth()->user()->id;;
        $this->data['gallery']->active = $request->active;
        $this->data['gallery']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
            
    	return redirect()->back();
    }

    public function destroy(request $request, $id){
        $gallery = Gallery::find($id);
        $gallery->delete();
        $request->session()->flash('message_delete', 'Data Successfully Deleted!');
        return redirect()->back();
    }

    public function sorting(){
        $this->data['gallery'] = DB::table('gallery')
                ->orderBy('order', 'asc')
                ->get();
        return $this->render_view('pages.preferences.settings.gallery.sorting');
    }
    
    public function doSorting(request $request){
        $this->data['gallery'] = Gallery::get();
        $i=0;
        foreach ($request->id as $key) {
            $i++;
            DB::table('gallery')
            ->where('id', $key)
            ->update(['order' => $i]);
        }
        $request->session()->flash('message', 'Data Successfully Sorted!');
        return redirect()->back();
    }
}
