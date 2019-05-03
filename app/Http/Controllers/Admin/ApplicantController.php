<?php
namespace App\Http\Controllers\Admin;

use illuminate\Http\request;
use App\Models\Applicant;
use App\Models\ApplicantStatus;
use App\Models\VacancyPost;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Session;

class ApplicantController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $this->data['vacancypost'] = VacancyPost::with('total_applicant')->orderby('title','asc')->get();
        $this->data['statuscarousel']   = ApplicantStatus::orderby('order','asc')->with('total_applicant')->get();
        $this->data['applicantstatus'] = ApplicantStatus::orderBy('order','asc')->get();
        $this->data['applicant'] = new Applicant;
        $this->data['filter'] = "";
        $array = null;
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['firstname','email','phone','title','updated_at','status_id']) ? $sort : 'updated_at';
        $order = $request->input('order') === 'desc' ? 'asc' : 'desc';
        $applicant = Applicant::join('vacancy_post','applicant.id_vacancy_post','=','vacancy_post.id')
                                ->select('applicant.*','vacancy_post.title')
                                ->orderBy($sort,$order)
                                ->paginate(10);
        if($request->has('filter')){
            $array['filter'] = $request->filter;
            $this->data['filter'] = $request->filter;
            $applicant = Applicant::join('vacancy_post','applicant.id_vacancy_post','=','vacancy_post.id')
                                    ->join('applicant_status','applicant.status_id','=','applicant_status.id')
                                    ->select('applicant.*','vacancy_post.title')
                                    ->where('applicant_status.status','=',ucwords(str_replace('-','_',$request->filter),'_'))
                                    ->orderBy($sort,$order)
                                    ->paginate(10);
        }
        if($request->has('search')){
            $array['search'] = $request->search;
            $applicant = Applicant::join('vacancy_post','applicant.id_vacancy_post','=','vacancy_post.id')
                                                ->select('applicant.*','vacancy_post.title')
                                                ->where('email','like','%'.$request->search.'%')
                                                ->orwhere('firstname','like','%'.$request->search.'%')
                                                ->orwhere('lastname','like','%'.$request->search.'%')
                                                ->orwhere('title','like','%'.$request->search.'%')
                                                ->orderBy($sort,$order)
                                                ->paginate(10);
        }
        if($request->has('search') && $request->has('filter')){
            $array['search'] = $request->search;
            $array['filter'] = $request->filter;
            $filter = ucwords(str_replace('-','_',$request->filter),'_');
            
            $applicant = Applicant::join('vacancy_post','applicant.id_vacancy_post','=','vacancy_post.id')
                                ->join('applicant_status','applicant.status_id','=','applicant_status.id')
                                ->select('applicant.*','vacancy_post.title')
                                ->where('applicant_status.status','LIKE','%'.$filter.'%')
                                ->where('email','like','%'.$request->search.'%')
                                ->orwhere('applicant_status.status','LIKE','%'.$filter.'%')
                                ->where('firstname','like','%'.$request->search.'%')
                                ->orwhere('applicant_status.status','LIKE','%'.$filter.'%')
                                ->where('lastname','like','%'.$request->search.'%')
                                ->orwhere('applicant_status.status','LIKE','%'.$filter.'%')
                                ->where('title','like','%'.$request->search.'%')
                                ->orderBy($sort,$order)
                                ->paginate(10);
        }

        $applicant->appends($array);
        $this->data['applicant'] = $applicant;
        $this->data['order'] = $order;
        $this->data['a'] = ucwords(str_replace('-',' ',$request->filter),'_');
        return $this->render_view('pages.preferences.settings.applicants.index');
    }

    public function show($id,$status){
        $order = ApplicantStatus::where('id','=',$status)->first();
        $this->data['applicantstatus'] = ApplicantStatus::where('order','>',$order->order)->orderBy('order','asc')->get();
        $this->data['template'] = EmailTemplate::where('active','=',1)->get();
        $applicant = Applicant::join('vacancy_post','applicant.id_vacancy_post','=','vacancy_post.id')
                                   ->join('applicant_status','applicant.status_id','=','applicant_status.id')
                                   ->select('applicant.*','vacancy_post.title')
                                   ->where('applicant.id','=',$id)
                                   ->first();

        $this->data['log'] = Applicant::join('vacancy_post','applicant.id_vacancy_post','=','vacancy_post.id')
                                      ->join('applicant_status','applicant.status_id','=','applicant_status.id')
                                      ->select('applicant.email','applicant.phone','vacancy_post.title','applicant_status.status')
                                      ->where('applicant.phone','=',$applicant->phone)
                                      ->where('applicant.email','=',$applicant->email)
                                      ->groupby('vacancy_post.title','applicant.email','applicant.phone','applicant_status.status')
                                      ->get();

        $this->data['applicant'] = $applicant;

        return $this->render_view('pages.preferences.settings.applicants.modal');
    }

    public function update(request $request, $id){
        $this->data['applicant'] = Applicant::find($id);
        if($request->status_id!="0"){
            $this->data['applicant']->read_by = auth()->user()->id;
            $this->data['applicant']->status_id = $request->status_id;
            $this->data['applicant']->save();
            $request->session()->flash('message', 'Data Has Been Updated!');
        }
        return redirect()->back();
    }

    public function doUpdate(request $request){
        $this->data['applicant'] = Applicant::get();
        $status = $request->status_id;
        $id[] = $request->id;
        $time = Carbon::now();
        if($request->action == 'Email'){
            if($id[0] != null){
                $this->data['mail'] = DB::table('applicant')
                    ->whereIn('id',$request->id)
                    ->get();
                $this->data['template'] = EmailTemplate::where('active','=',1)->get();
                return $this->render_view('pages.preferences.settings.applicants.email');
                
            }
            else{
                $request->session()->flash('message-failed','You Must Choose The Applicant!');
                return redirect()->back();
            }
            
        }
        else{
            if($id[0] == null){
                 $request->session()->flash('message-failed','You Must Choose The Applicant!');
            }
            else if($status == '0'){
                $request->session()->flash('message-failed','You Must Choose Where To Move!');
            }
            else{
                foreach($request->id as $key){
                    DB::table('applicant')
                    ->where('id', $key)
                    ->update(['status_id' => $status, 'updated_at' => $time, 'read_by' => auth()->user()->id]);
                }
                $request->session()->flash('message', 'Data Successfully Updated!');
            }
            return redirect()->back();
        }
        
    }

    public function template1($template){
        $temp = null;
        $result = EmailTemplate::where('id','=',$template)->get();
        $temp = $result;
        $this->data['email_template'] = $result;
        return $this->render_view('pages.preferences.settings.applicants.template');
    }

    public function template($category,$template){
        $temp = null;
        $result = EmailTemplate::where('id','=',$template)->get();
        $temp = $result;
        $this->data['email_template'] = $result;
        return $this->render_view('pages.preferences.settings.applicants.template');
    }

    public function category($category, request $request){
        $array = null;
        $this->data['filter'] = "";
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['firstname','email','phone','title','created_at']) ? $sort : 'updated_at';
        $order = $request->input('order') === 'desc' ? 'asc' : 'desc';
        $category                       = VacancyPost::where('post_alias',$category)->first();
        $this->data['statuscarousel']   = ApplicantStatus::orderby('applicant_status.order','asc')
                                                         ->with(['total_applicant' => function($q) use($category){
                                                            $q->where('id_vacancy_post',$category->id);
                                                         }])
                                                         ->get();
        $this->data['applicantstatus'] = ApplicantStatus::orderBy('order','asc')->get();
        $this->data['vacancypost'] = VacancyPost::with('total_applicant')->orderby('title','asc')->get();
        $this->data['applicant'] = Applicant::get();
        $applicant = Applicant::join('vacancy_post','applicant.id_vacancy_post','=','vacancy_post.id')
                                            ->join('applicant_status','applicant.status_id','=','applicant_status.id')
                                            ->select('applicant.*','vacancy_post.title')
                                            ->where('applicant.id_vacancy_post','=',$category->id)
                                            ->orderBy('applicant.created_at','desc')
                                            ->paginate(10);
        if($request->has('filter')){
            $array['filter'] = $request->filter;
            $this->data['filter'] = $request->filter;
            $applicant = Applicant::join('vacancy_post','applicant.id_vacancy_post','=','vacancy_post.id')
                                    ->join('applicant_status','applicant.status_id','=','applicant_status.id')
                                    ->select('applicant.*','vacancy_post.title')
                                    ->where('applicant_status.status','=',ucwords(str_replace('-','_',$request->filter),'_'))
                                    ->where('applicant.id_vacancy_post','=',$category->id)
                                    ->orderBy($sort,$order)
                                    ->paginate(10);
        }
        $this->data['applicant'] = $applicant->appends($array);
        $this->data['order'] = $order;
        $this->data['a'] = ucwords(str_replace('-',' ',$request->filter),'_');
        return $this->render_view('pages.preferences.settings.applicants.index');
    }
}
