<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\DB;
use Image;
use Session;

class BlogCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['blogcategory'] = new BlogCategory;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['name','name_alias','order','active']) ? $sort : 'order';
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
        if($request->has('search')){
            $this->data['blogcategory'] = BlogCategory::where('name','like','%'.$request->search.'%')
                                                      ->orWhere('name_alias','like','%'.$request->search.'%')
                                                      ->orderBy($sort,$order)
                                                      ->paginate(10);
        }
        else{
            $this->data['blogcategory'] = BlogCategory::orderBy($sort,$order)
                                                      ->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.blog-category.index');
    }

    public function create(){
        return $this->render_view('pages.preferences.settings.blog-category.insert');
    }

    public function store(request $request){
        $blogcategory = new BlogCategory;
        $blogcategory->name = $request->name;
        $blogcategory->name_alias = $request->name_alias;
        $blogcategory->order = $request->order;
        $blogcategory->active = $request->active;
        $blogcategory->created_by = auth()->user()->id;
        if($blogcategory->name && $blogcategory->name_alias && $blogcategory->order && $blogcategory->created_by){
            $blogcategory->save();
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
        $this->data['blogcategory'] = BlogCategory::find($id);
        return $this->render_view('pages.preferences.settings.blog-category.update');
    }

    public function update(request $request, $id){
    	$this->data['blogcategory'] = BlogCategory::find($id);
        $this->data['blogcategory']->name = $request->name;
        $this->data['blogcategory']->name_alias = $request->name_alias;
        $this->data['blogcategory']->order = $request->order;
        $this->data['blogcategory']->created_by = $request->created_by;
        $this->data['blogcategory']->updated_by = auth()->user()->id;
        $this->data['blogcategory']->active = $request->active;
        $this->data['blogcategory']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
    	return redirect()->back();
    }

    public function destroy(request $request, $id){
        $blogcategory = BlogCategory::find($id);
        $blogcategory->delete();
        $request->session()->flash('message_delete', 'Data Successfully Deleted!');
        return redirect('admin/blog-category');
    }

    public function sorting(){
        $this->data['blogcategory'] = DB::table('blog_category')
                ->orderBy('order', 'asc')
                ->get();
        return $this->render_view('pages.preferences.settings.blog-category.sorting');
    }

    public function doSorting(request $request){
        $this->data['blogcategory'] = BlogCategory::get();
        $i=0;
        foreach ($request->id as $key) {
            $i++;
            DB::table('blog_category')
            ->where('id', $key)
            ->update(['order' => $i]);
        }
        $request->session()->flash('message', 'Data Successfully Sorted!');
        return redirect()->back();
    }
}
