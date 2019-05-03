<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\CompanyValue;
use Illuminate\Support\Facades\DB;
use Image;
use Session;

class CompanyValueController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['companyvalue'] = new CompanyValue;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['name','description','order','active']) ? $sort : 'order';
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
        if($request->has('search')){
            $this->data['companyvalue']  = CompanyValue::where('name','like','%'.$request->search.'%')
                                                       ->orderBy($sort,$order)
                                                       ->paginate(10);
        }
        else{
            $this->data['companyvalue'] = CompanyValue::orderBy($sort,$order)
                                                     ->paginate(10);    
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.company-value.index');
    }

    public function create(){
        return $this->render_view('pages.preferences.settings.company-value.insert');
    }

    public function store(request $request){
        $companyvalue = new CompanyValue;
        $temp = null;
        if($request->content){
            $i=0;
            $split_detailcorvalue = strip_tags($request->content);
            $split_detailcorvalue = explode("\n",$split_detailcorvalue);
            foreach($split_detailcorvalue as $key){
                $strlen = strlen($key)-1;
                $temp = $temp."<div><b>".substr($key,0,1)."</b>".substr($key,1,$strlen)."</div>";
                $i++;
            }
        }
        $companyvalue->name = $request->name;
        $companyvalue->description = $request->description;
        $companyvalue->content = $temp;
        $companyvalue->active = $request->active;
        $companyvalue->order = $request->order;
        $companyvalue->created_by = auth()->user()->id;
        if($request->hasFile('thumbnail')){
            $this->validate($request,['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=150,max_width=200,min_height=150,max_height=200']);
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/company-value/'.$key);
    		$companyvalue->thumbnail = $key;
        }
        if($companyvalue->name && $companyvalue->description && $companyvalue->content && $companyvalue->thumbnail && $companyvalue->order && $companyvalue->created_by){
            $companyvalue->save();
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
        $this->data['companyvalue'] = CompanyValue::find($id);
        return $this->render_view('pages.preferences.settings.company-value.update');
    }

    public function update(request $request, $id){
    	$this->data['companyvalue'] = CompanyValue::find($id);
        $temp = null;
        if($request->hasFile('thumbnail')){
            $this->validate($request,['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=150,max_width=200,min_height=150,max_height=200']);
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/company-value/'.$key);
    		$this->data['companyvalue']->thumbnail = $key;
        }
        if($request->content){
            $i=0;
            $split_detailcorvalue = strip_tags($request->content);
            $split_detailcorvalue = explode("\n",$split_detailcorvalue);
            foreach($split_detailcorvalue as $key){
                $strlen = strlen($key)-1;
                $temp = $temp."<div><b>".substr($key,0,1)."</b>".substr($key,1,$strlen)."</div>";
                $i++;
            }
        }
        $this->data['companyvalue']->name = $request->name;
        $this->data['companyvalue']->description = $request->description;
        $this->data['companyvalue']->content = $temp;
        $this->data['companyvalue']->order = $request->order;
        $this->data['companyvalue']->created_by = $request->created_by;
        $this->data['companyvalue']->updated_by = auth()->user()->id;;
        $this->data['companyvalue']->active = $request->active;
        $this->data['companyvalue']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
    	return redirect()->back();
    }

    public function destroy(request $request, $id){
        $companyvalue = CompanyValue::find($id);
        $companyvalue->delete();
        $request->session()->flash('message_delete', 'Data Successfully Deleted!');
        return redirect()->back();
    }

    public function sorting(){
        $this->data['companyvalue'] = DB::table('company_value')
                ->orderBy('order', 'asc')
                ->get();
        return $this->render_view('pages.preferences.settings.company-value.sorting');
    }
    
    public function doSorting(request $request){
        $this->data['companyvalue'] = CompanyValue::get();
        $i=0;
        foreach ($request->id as $key) {
            $i++;
            DB::table('company_value')
            ->where('id', $key)
            ->update(['order' => $i]);
        }
        $request->session()->flash('message', 'Data Successfully Sorted!');
        return redirect()->back();
    }
}
