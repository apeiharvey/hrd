<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\VacancyPost;
use Illuminate\Support\Facades\DB;
use App\Models\VacancyCategory;
use Image;
use Session;
use Carbon\Carbon;

class VacancyPostController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['vacancypost'] = new VacancyPost;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['order','title','name','active']) ? $sort : 'order';
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
        if($request->has('search')){
            $this->data['vacancypost'] = VacancyPost::join('vacancy_category','vacancy_post.category_id','=','vacancy_category.id')
                                                    ->select('vacancy_post.*','vacancy_category.name','vacancy_category.name_alias')
                                                    ->where('title','like','%'.$request->search.'%')
                                                    ->orwhere('name','like','%'.$request->search.'%')
                                                    ->orwhere('name_alias','like','%'.$request->search.'%')
                                                    ->orderBy($sort,$order)
                                                    ->paginate(10);
        }
        else{
            $this->data['vacancypost'] = VacancyPost::join('vacancy_category','vacancy_post.category_id','=','vacancy_category.id')
                                                    ->select('vacancy_post.*','vacancy_category.name')
                                                    ->orderBy($sort,$order)
                                                    ->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.vacancy-post.index');
    }

    public function create(){
        $this->data['vacancycategory'] = VacancyCategory::get();
        return $this->render_view('pages.preferences.settings.vacancy-post.insert');
    }

    public function store(request $request){
        $vacancypost = new VacancyPost;
        $vacancypost->category_id = $request->category_id;
        $vacancypost->title = $request->title;
        $vacancypost->description = $request->description;
        $vacancypost->responsibilities = $request->responsibilities;
        $vacancypost->requirements = $request->requirements;
        $vacancypost->active = $request->active;
        $vacancypost->order = $request->order;
        $vacancypost->meta_title = $request->meta_title;
        $vacancypost->meta_description = $request->meta_description;
        $vacancypost->meta_keywords = $request->meta_keywords;
        $vacancypost->created_by = auth()->user()->id;
        if($request->title){
            $vacancypost->post_alias = preg_replace('~[^a-zA-Z0-9 ]+~', '', $request->title);
            $vacancypost->post_alias = str_replace(" ","-",$vacancypost->post_alias);
            $vacancypost->post_alias = strtolower($vacancypost->post_alias);
        }
        if($vacancypost->category_id && $vacancypost->title && $vacancypost->description && $vacancypost->responsibilities && $vacancypost->requirements && $vacancypost->order && $vacancypost->meta_title && $vacancypost->meta_description && $vacancypost->meta_keywords){
            $vacancypost->save();
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
        $this->data['vacancypost'] = VacancyPost::find($id);
        $this->data['vacancycategory'] = VacancyCategory::get();
        return $this->render_view('pages.preferences.settings.vacancy-post.update');
    }

    public function update(request $request, $id){
    	$this->data['vacancypost'] = VacancyPost::find($id);
        $this->data['vacancypost']->category_id = $request->category_id;
        $this->data['vacancypost']->title = $request->title;
        if($request->title){
            $this->data['vacancypost']->post_alias = preg_replace('~[^a-zA-Z0-9 ]+~', '', $request->title);
            $this->data['vacancypost']->post_alias = str_replace(" ","-",$this->data['vacancypost']->post_alias);
            $this->data['vacancypost']->post_alias = strtolower($this->data['vacancypost']->post_alias);
        }
        $this->data['vacancypost']->description = $request->description;
        $this->data['vacancypost']->responsibilities = $request->responsibilities;
        $this->data['vacancypost']->requirements = $request->requirements;
        $this->data['vacancypost']->meta_title = $request->meta_title;
        $this->data['vacancypost']->meta_description = $request->meta_description;
        $this->data['vacancypost']->meta_keywords = $request->meta_keywords;
        $this->data['vacancypost']->order = $request->order;
        $this->data['vacancypost']->created_by = $request->created_by;
        $this->data['vacancypost']->updated_by = auth()->user()->id;
        if($this->data['vacancypost']->active != $request->active){
            $this->data['vacancypost']->last_updated = Carbon::now();
        }
        $this->data['vacancypost']->active = $request->active;
        $this->data['vacancypost']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
    	return redirect()->back();
    }

    public function sorting(){
        $this->data['vacancypost'] = DB::table('vacancy_post')
                ->orderBy('order', 'asc')
                ->get();
        return $this->render_view('pages.preferences.settings.vacancy-post.sorting');
    }

    public function doSorting(request $request){
        $this->data['vacancypost'] = VacancyPost::get();
        $i=0;
        foreach ($request->id as $key) {
            $i++;
            DB::table('vacancy_post')
            ->where('id', $key)
            ->update(['order' => $i]);
        }
        $request->session()->flash('message', 'Category Successfully Updated!');
        return redirect()->back();
    }
}
