<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\CompanyPost;
use Illuminate\Support\Facades\DB;
use App\Models\CompanyCategory;
use Image;
use Session;

class CompanyPostController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['companypost'] = new CompanyPost;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['name','title','url','order','active']) ? $sort : 'order';
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
        if($request->has('search')){
            $this->data['companypost'] = CompanyPost::join('company_category','company_post.category_id','=','company_category.id')
                                                    ->select('company_post.*','company_category.name')
                                                    ->where('name','like','%'.$request->search.'%')
                                                    ->orwhere('title','like','%'.$request->search.'%')
                                                    ->orderBy($sort,$order)
                                                    ->paginate(10);
        }
        else{
            $this->data['companypost'] = CompanyPost::join('company_category','company_post.category_id','=','company_category.id')
                                                    ->select('company_post.*','company_category.name')
                                                    ->orderBy($sort,$order)
                                                    ->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.company-post.index');
    }

    public function create(){
        $this->data['companycategory'] = CompanyCategory::get();
        return $this->render_view('pages.preferences.settings.company-post.insert');
    }

    public function store(request $request){
        $companypost = new CompanyPost;
        $companypost->title = $request->title;
        $companypost->category_id = $request->category;
        $companypost->url = $request->url;
        $companypost->active = $request->active;
        $companypost->description = $request->description;
        $companypost->description_eng = $request->description_eng;
        $companypost->order = $request->order;
        $companypost->created_by = auth()->user()->id;
        if($request->hasFile('thumbnail')){
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/company-post/'.$key);
    		$companypost->thumbnail = $key;
        }
        if($companypost->title && $companypost->thumbnail && $companypost->description && $companypost->url && $companypost->order && $companypost->created_by && $companypost->description_eng){
            $companypost->save();
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
        $this->data['companycategory'] = CompanyCategory::get();
        $this->data['companypost'] = CompanyPost::find($id);
        return $this->render_view('pages.preferences.settings.company-post.update');
    }

    public function update(request $request, $id){
    	$this->data['companypost'] = CompanyPost::find($id);
        if($request->hasFile('thumbnail')){
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/company-post/'.$key);
    		$this->data['companypost']->thumbnail = $key;
        }
        $this->data['companypost']->description = $request->description;
        $this->data['companypost']->description_eng = $request->description_eng;
        $this->data['companypost']->title = $request->title;
        $this->data['companypost']->url = $request->url;
        $this->data['companypost']->order = $request->order;
        $this->data['companypost']->created_by = $request->created_by;
        $this->data['companypost']->updated_by = auth()->user()->id;;
        $this->data['companypost']->active = $request->active;
        $this->data['companypost']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
    	return redirect()->back();
    }

    public function destroy(request $request, $id){
        $companypost = CompanyPost::find($id);
        $companypost->delete();
        $request->session()->flash('message_delete', 'Data Successfully Deleted!');
        return redirect()->back();
    }

    public function sorting(){
        $this->data['companypost'] = DB::table('company_post')
                ->orderBy('order', 'asc')
                ->get();
        return $this->render_view('pages.preferences.settings.company-post.sorting');
    }
    public function doSorting(request $request){
        $this->data['companypost'] = CompanyPost::get();
        $i=0;
        foreach ($request->id as $key) {
            $i++;
            DB::table('company_post')
            ->where('id', $key)
            ->update(['order' => $i]);
        }
        $request->session()->flash('message', 'Data Successfully Sorted!');
        return redirect()->back();
    }
}
