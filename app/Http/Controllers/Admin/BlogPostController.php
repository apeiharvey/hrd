<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\BlogPost;
use Illuminate\Support\Facades\DB;
use App\Models\BlogCategory;
use Image;
use Session;

class BlogPostController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['blogpost'] = new BlogPost;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['title','view','order','active']) ? $sort : 'created_at';
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';
        if($request->has('search')){
            $this->data['blogpost'] = BlogPost::join('blog_category','blog_post.category_id','=','blog_category.id')
                                              ->select('blog_post.*','blog_category.name')
                                              ->where('title','like','%'.$request->search.'%')
                                              ->orwhere('name','like','%'.$request->search.'%')
                                              ->orderBy($sort,$order)
                                              ->paginate(10);
        }
        else{
            $this->data['blogpost'] = BlogPost::orderBy($sort,$order)
                                              ->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.blog-post.index');
    }

    public function create(){
        $this->data['blogcategory'] = BlogCategory::get();
        return $this->render_view('pages.preferences.settings.blog-post.insert');
    }

    public function store(request $request){
        $blogpost = new BlogPost;
        $blogpost->title = $request->title;
        $blogpost->content = $request->content;
        $blogpost->category_id = $request->category;
        $blogpost->order = $request->order;
        $blogpost->active = $request->active;
        $blogpost->created_by = auth()->user()->id;
        $blogpost->meta_title = $request->meta_title;
        $blogpost->meta_description = $request->meta_description;
        $blogpost->meta_keywords = $request->meta_keywords;
        if($request->title){
            $blogpost->title_alias = preg_replace('~[^a-zA-Z0-9 ]+~', '', $request->title);
            $blogpost->title_alias = str_replace(" ","-",$blogpost->title_alias);
            $blogpost->title_alias = strtolower($blogpost->title_alias);
        }
        $this->validate($request,['title' => 'required|max:70']);
        if($request->hasFile('thumbnail')){
            $this->validate($request,['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=500,max_width=500,min_height=400,max_height=400']);
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/blog-post/'.$key);
    		$blogpost->thumbnail = $key;
        }
        if($blogpost->title && $blogpost->content && $blogpost->category_id && $blogpost->order && $blogpost->created_by && $blogpost->thumbnail && $blogpost->title_alias){
            $blogpost->save();
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
        $this->data['blogpost'] = BlogPost::find($id);
        $this->data['blogcategory'] = Blogcategory::get();
        return $this->render_view('pages.preferences.settings.blog-post.update');
    }

    public function update(request $request, $id){
    	$this->data['blogpost'] = BlogPost::find($id);
        if($request->hasFile('thumbnail')){
            $this->validate($request,['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=500,max_width=500,min_height=400,max_height=400']);
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/blog-post/'.$key);
    		$this->data['blogpost']->thumbnail = $key;
        }
        $this->data['blogpost']->title = $request->title;
        if($request->title){
            $this->data['blogpost']->title_alias = preg_replace('~[^a-zA-Z0-9 ]+~', '', $request->title);
            $this->data['blogpost']->title_alias = str_replace(" ","-",$this->data['blogpost']->title_alias);
            $this->data['blogpost']->title_alias = strtolower($this->data['blogpost']->title_alias);
        }
        $this->data['blogpost']->category_id = $request->category;
        $this->data['blogpost']->content = $request->content;
        $this->data['blogpost']->meta_title = $request->meta_title;
        $this->data['blogpost']->meta_keywords = $request->meta_keywords;
        $this->data['blogpost']->meta_description = $request->meta_description;
        $this->data['blogpost']->order = $request->order;
        $this->data['blogpost']->created_by = $request->created_by;
        $this->data['blogpost']->updated_by = auth()->user()->id;
        $this->data['blogpost']->active = $request->active;
        $this->data['blogpost']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
            
    	return redirect()->back();
    }

    public function destroy(request $request, $id){
        $blogpost = BlogPost::find($id);
        $blogpost->delete();
        $request->session()->flash('message_delete', 'Data Successfully Deleted!');
        return redirect()->back();

    }

     public function sorting(){
        $this->data['blogpost'] = DB::table('blog_post')
                ->orderBy('order', 'asc')
                ->get();
        return $this->render_view('pages.preferences.settings.blog-post.sorting');
    }

    public function doSorting(request $request){
        $this->data['blogpost'] = BlogPost::get();
        $i=0;
        foreach ($request->id as $key) {
            $i++;
            DB::table('blog_post')
            ->where('id', $key)
            ->update(['order' => $i]);
        }
        $request->session()->flash('message', 'Data Successfully Sorted!');
        return redirect()->back();
    }
}
