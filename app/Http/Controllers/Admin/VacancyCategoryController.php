<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\VacancyCategory;
use Illuminate\Support\Facades\DB;
use Image;
use Session;

class VacancyCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['vacancycategory'] = new VacancyCategory;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['name','name_alias','order','active']) ? $sort : 'order';
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
        if($request->has('search')){
            $this->data['vacancycategory']  = VacancyCategory::where('name','like','%'.$request->search.'%')
                                                ->orwhere('name_alias','like','%'.$request->search.'%')
                                                ->orderBy($sort,$order)
                                                ->paginate(10);
        }
        else{
            $this->data['vacancycategory'] = VacancyCategory::orderBy($sort,$order)
                                                            ->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.vacancy-category.index');
    }

    public function create(){
        return $this->render_view('pages.preferences.settings.vacancy-category.insert');
    }

    public function store(request $request){
        $vacancycategory = new VacancyCategory;
        $vacancycategory->name = $request->name;
        $vacancycategory->name_alias = $request->name_alias;
        $vacancycategory->order = $request->order;
        $vacancycategory->active = $request->active;
        $vacancycategory->created_by = auth()->user()->id;
        if($request->name){
            $vacancycategory->category_alias = preg_replace('~[^a-zA-Z0-9 ]+~', '', $request->name);
            $vacancycategory->category_alias = str_replace(" ","-",$vacancycategory->category_alias);
            $vacancycategory->category_alias = strtolower($vacancycategory->category_alias);
        }
        if($request->hasFile('thumbnail')){
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/vacancy-category/'.$key);
    		$vacancycategory->thumbnail = $key;
        }
        if($vacancycategory->name && $vacancycategory->name_alias && $vacancycategory->thumbnail && $vacancycategory->order && $vacancycategory->created_by){
            $vacancycategory->save();
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
        $this->data['vacancycategory'] = VacancyCategory::find($id);
        return $this->render_view('pages.preferences.settings.vacancy-category.update');
    }

    public function update(request $request, $id){
    	$this->data['vacancycategory'] = VacancyCategory::find($id);
        if($request->hasFile('thumbnail')){
            $this->validate($request,['thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,max_width=100,min_height=100,max_height=100']);
			$img = Image::make($request->thumbnail);
            $key = str_random(5).'.'.explode('/',$img->mime)[1];
            $img->save('images/frontend/vacancy-category/'.$key);
    		$this->data['vacancycategory']->thumbnail = $key;
        }
        if($request->name){
            $this->data['vacancycategory']->category_alias = preg_replace('~[^a-zA-Z0-9 ]+~', '', $request->name);
            $this->data['vacancycategory']->category_alias = str_replace(" ","-",$this->data['vacancycategory']->category_alias);
            $this->data['vacancycategory']->category_alias = strtolower($this->data['vacancycategory']->category_alias);
        }
        $this->data['vacancycategory']->name = $request->name;
        $this->data['vacancycategory']->name_alias = $request->name_alias;
        $this->data['vacancycategory']->order = $request->order;
        $this->data['vacancycategory']->created_by = $request->created_by;
        $this->data['vacancycategory']->updated_by = auth()->user()->id;;
        $this->data['vacancycategory']->active = $request->active;
        $this->data['vacancycategory']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
            
    	return redirect()->back();
    }

    public function sorting(){
        $this->data['vacancycategory'] = DB::table('vacancy_category')
                ->orderBy('order', 'asc')
                ->get();
        return $this->render_view('pages.preferences.settings.vacancy-category.sorting');
    }

    public function doSorting(request $request){
        $this->data['vacancycategory'] = VacancyCategory::get();
        $i=0;
        foreach ($request->id as $key) {
            $i++;
            DB::table('vacancy_category')
            ->where('id', $key)
            ->update(['order' => $i]);
        }
        $request->session()->flash('message', 'Category Successfully Updated!');
        return redirect()->back();
    }
}
