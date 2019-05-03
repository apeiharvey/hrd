<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\CompanyCategory;
use Illuminate\Support\Facades\DB;
use Image;
use Session;

class CompanyCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['companycategory'] = new CompanyCategory;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['name','name_alias','order','active']) ? $sort : 'order';
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
        if($request->has('search')){
            $this->data['companycategory'] = CompanyCategory::where('name','like','%'.$request->search.'%')
                                                            ->orderBy($sort,$order)
                                                            ->paginate(10);
        }
        else{
            $this->data['companycategory'] = CompanyCategory::orderBy($sort,$order)
                                                            ->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.company-category.index');
    }

    public function create(){
        return $this->render_view('pages.preferences.settings.company-category.insert');
    }

    public function store(request $request){
        $companycategory = new CompanyCategory;
        $companycategory->name = $request->name;
        $companycategory->name_alias = $request->name_alias;
        $companycategory->order = $request->order;
        $companycategory->active = $request->active;
        $companycategory->created_by = auth()->user()->id;
        if($request->hasFile('thumbnail')){
            $this->validate($request,['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,max_width=100,min_height=100,max_height=100']);
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/company-category/'.$key);
    		$companycategory->thumbnail = $key;
        }
        if($companycategory->name && $companycategory->name_alias && $companycategory->order && $companycategory->created_by && $companycategory->thumbnail){
            $companycategory->save();
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
        $this->data['companycategory'] = CompanyCategory::find($id);
        return $this->render_view('pages.preferences.settings.company-category.update');
    }

    public function update(request $request, $id){
    	$this->data['companycategory'] = CompanyCategory::find($id);
        if($request->hasFile('thumbnail')){
            $this->validate($request,['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,max_width=100,min_height=100,max_height=100']);
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/company-category/'.$key);
    		$this->data['companycategory']->thumbnail = $key;
        }
        $this->data['companycategory']->name = $request->name;
        $this->data['companycategory']->name_alias = $request->name_alias;
        $this->data['companycategory']->order = $request->order;
        $this->data['companycategory']->created_by = $request->created_by;
        $this->data['companycategory']->updated_by = auth()->user()->id;;
        $this->data['companycategory']->active = $request->active;
        $this->data['companycategory']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
            
    	return redirect()->back();
    }

    public function destroy(request $request, $id){
        $companycategory = CompanyCategory::find($id);
        $companycategory->delete();
        $request->session()->flash('message_delete', 'Data Successfully Deleted!');
        return redirect()->back();
    }

    public function sorting(){
        $this->data['companycategory'] = DB::table('company_category')
                ->orderBy('order', 'asc')
                ->get();
        return $this->render_view('pages.preferences.settings.company-category.sorting');
    }
    
    public function doSorting(request $request){
        $this->data['companycategory'] = CompanyCategory::get();
        $i=0;
        foreach ($request->id as $key) {
            $i++;
            DB::table('company_category')
            ->where('id', $key)
            ->update(['order' => $i]);
        }
        $request->session()->flash('message', 'Data Successfully Sorted!');
        return redirect()->back();
    }
}
