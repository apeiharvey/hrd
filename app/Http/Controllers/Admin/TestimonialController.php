<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use Image;
use Session;

class TestimonialController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['testimonial'] = new Testimonial;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['name','position','order','active']) ? $sort : 'order';
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
        if($request->has('search')){
            $this->data['testimonial'] = Testimonial::where('name','like','%'.$request->search.'%')
                                                    ->orWhere('testimony','like','%'.$request->search.'%')
                                                    ->orderBy($sort,$order)
                                                    ->paginate(10);
        }
        else{
            $this->data['testimonial'] = Testimonial::orderBy($sort,$order)
                                                    ->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.testimonial.index');
    }

    public function create(){
        return $this->render_view('pages.preferences.settings.testimonial.insert');
    }

    public function store(request $request){
        $testimonial = new Testimonial;
        $testimonial->name = $request->name;
        $testimonial->position = $request->position;
        $testimonial->testimony = $request->testimony;
        $testimonial->order = $request->order;
        $testimonial->active = $request->active;
        $testimonial->created_by = auth()->user()->id;
        if($testimonial->name && $testimonial->position && $testimonial->testimony && $testimonial->order && $testimonial->created_by && $testimonial->active){
            $testimonial->save();
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
        $this->data['testimonial'] = Testimonial::find($id);
        return $this->render_view('pages.preferences.settings.testimonial.update');
    }

    public function update(request $request, $id){
    	$this->data['testimonial'] = Testimonial::find($id);
        $this->data['testimonial']->name = $request->name;
        $this->data['testimonial']->position = $request->position;
        $this->data['testimonial']->testimony = $request->testimony;
        $this->data['testimonial']->order = $request->order;
        $this->data['testimonial']->active = $request->active;
        $this->data['testimonial']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
            
    	return redirect()->back();
    }

    public function destroy(request $request, $id){
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        $request->session()->flash('message_delete', 'Data Successfully Deleted!');
        return redirect()->back();
    }

    public function sorting(){
        $this->data['testimonial'] = DB::table('testimonial')
                ->orderBy('order', 'asc')
                ->get();
        return $this->render_view('pages.preferences.settings.testimonial.sorting');
    }
    
    public function doSorting(request $request){
        $this->data['testimonial'] = Testimonial::get();
        $i=0;
        foreach ($request->id as $key) {
            $i++;
            DB::table('testimonial')
            ->where('id', $key)
            ->update(['order' => $i]);
        }
        $request->session()->flash('message', 'Data Successfully Sorted!');
        return redirect()->back();
    }
}
