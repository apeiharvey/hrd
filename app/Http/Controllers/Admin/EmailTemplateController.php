<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use Illuminate\Support\Facades\DB;
use App\Models\EmailTemplate;
use Session;

class EmailTemplateController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['template'] = new EmailTemplate;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['name','description','active']) ? $sort : 'name';
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
        if($request->has('search')){
            $this->data['template'] = EmailTemplate::where('name','like','%'.$request->search.'%')
                                                  ->orderBy($sort,$order)
                                                  ->paginate(10);
        }
        else{
            $this->data['template'] = EmailTemplate::orderBy($sort,$order)
                                                    ->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.email-template.index');
    }

    public function create(){
        return $this->render_view('pages.preferences.settings.email-template.insert');
    }

    public function store(request $request){
        $template = new EmailTemplate;
        $template->name = $request->name;
        $template->description = $request->description;
        $template->created_by = auth()->user()->id;
        $template->active = $request->active;
        if($template->name && $template->description && $template->active){
            $template->save();
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
        $this->data['template'] = EmailTemplate::find($id);
        return $this->render_view('pages.preferences.settings.email-template.update');
    }

    public function update(request $request, $id){
    	$this->data['template'] = EmailTemplate::find($id);
        $this->data['template']->name = $request->name;
        $this->data['template']->active = $request->active;
        $this->data['template']->description = $request->description;
        $this->data['template']->updated_by = auth()->user()->id;
        $this->data['template']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
            
    	return redirect()->back();
    }

    public function destroy(request $request, $id){
        $template = EmailTemplate::find($id);
        $template->delete();
        $request->session()->flash('message_delete', 'Data Successfully Deleted!');
        return redirect()->back();

    }
}
