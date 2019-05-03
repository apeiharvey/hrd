<?php

namespace App\Http\Controllers\Admin;
use illuminate\Http\request;
use App\Models\Applicant;
use App\Models\ApplicantStatus;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;
use DatePeriod;
use Session;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('block');
    	parent::__construct();
    }

    public function groupStatus($total){
        $applicant = array();
        $unread = 0;
        $process = 0;
        $rejected = 0;
        $hiring = 0;
        $shortlisted = 0;
        $failedinterview = 0;
        $offering = 0;
        $activefile = 0;
        $refuseoffering = 0;
        $trash = 0;
        $canceljoin = 0;
        $notshow = 0;
        foreach($total as $key){
            if($key->status == 'Interview_Process'){
                $applicant['Interview Process'] = ++$process;
            }
            if($key->status == 'Rejected'){
                $applicant['Rejected'] = ++$rejected;
            }
            if($key->status == 'Unread'){
                $applicant['Unread'] = ++$unread;
            }
            if($key->status == 'Hiring'){
                $applicant['Hiring'] = ++$hiring;
            }
            if($key->status == 'Short_Listed'){
                $applicant['Short Listed'] = ++$shortlisted;
            }
            if($key->status == 'Failed_Interview'){
                $applicant['Failed Interview'] = ++$failedinterview;
            }
            if($key->status == 'Offering'){
                $applicant['Offering'] = ++$offering;
            }
            if($key->status == 'Active_File'){
                $applicant['Active File'] = ++$activefile;
            }
            if($key->status == 'Refuse_Offering'){
                $applicant['Refuse Offering'] = ++$refuseoffering;
            }
            if($key->status == 'Trash'){
                $applicant['Trash'] = ++$trash;
            }
            if($key->status == 'Cancel_Join'){
                $applicant['Cancel Join'] = ++$canceljoin;
            }
            if($key->status == 'Not_Show'){
                $applicant['Not Show'] = ++$notshow;
            }
        }
        return $applicant;
    }

    public function groupTime($total){
        $data = array();
        $applicant = array();
        $results = array();
        $start    = (new DateTime(Carbon::now()->subYear(1)->addMonth(1)));
        $end      = (new DateTime(Carbon::now()->addMonth()));
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end); // Get a set of date beetween the 2 period
        $months = array();
        $unread = 0;
        $process = 0;
        $rejected = 0;
        $hiring = 0;
        $shortlisted = 0;
        $failedinterview = 0;
        $offering = 0;
        $activefile = 0;
        $refuseoffering = 0;
        $trash = 0;
        $canceljoin = 0;
        $notshow = 0;
        $time=0;
        foreach ($period as $dt) {
            $months[] = $dt->format("F Y");
        }
        $data['data'] = array();
        $data = array();
        foreach ($total as $key => $value) {
            $month= $value->created_at->format("F Y");
            $data[] = array("Month" => $month, "Status" => $value->status);
        }
        foreach ($months as $dateMonth) {
            $applicant['Hiring'] = 0;
            $applicant['Interview_Process'] = 0;
            $applicant['Rejected'] = 0;
            $applicant['Unread'] = 0;
            $applicant['Short_Listed'] = 0;
            $applicant['Failed_Interview'] = 0;
            $applicant['Offering'] = 0;
            $applicant['Active_File'] = 0;
            $applicant['Refuse_Offering'] = 0;
            $applicant['Trash'] = 0;
            $applicant['Cancel_Join'] = 0;
            $applicant['Not_Show'] = 0;
            for($i=0;$i<count($data);$i++){
                if($dateMonth == $data[$i]['Month']){
                    if($data[$i]['Status'] == 'Hiring'){
                        $applicant['Hiring'] = ++$hiring;
                    }
                    if($data[$i]['Status'] == 'Interview_Process'){
                        $applicant['Interview_Process'] = ++$process;
                    }
                    if($data[$i]['Status'] == 'Rejected'){
                        $applicant['Rejected'] = ++$rejected;
                    }
                    if($data[$i]['Status'] == 'Unread'){
                        $applicant['Unread'] = ++$unread;
                    }
                    if($data[$i]['Status'] == 'Short_Listed'){
                        $applicant['Short_Listed'] = ++$shortlisted;
                    }
                    if($data[$i]['Status'] == 'Failed_Interview'){
                        $applicant['Failed_Interview'] = ++$failedinterview;
                    }
                    if($data[$i]['Status'] == 'Offering'){
                        $applicant['Offering'] = ++$offering;
                    }
                    if($data[$i]['Status'] == 'Active_File'){
                        $applicant['Active_File'] = ++$activefile;
                    }
                    if($data[$i]['Status'] == 'Refuse_Offering'){
                        $applicant['Refuse_Offering'] = ++$refuseoffering;
                    }
                    if($data[$i]['Status'] == 'Trash'){
                        $applicant['Trash'] = ++$trash;
                    }
                    if($data[$i]['Status'] == 'Cancel_Join'){
                        $applicant['Cancel_Join'] = ++$canceljoin;
                    }
                    if($data[$i]['Status'] == 'Not_Show'){
                        $applicant['Not_Show'] = ++$notshow;
                    }
                }
            }
            $results[$dateMonth] = $applicant;
        }
        return $results;
    }

    public function index(){
        $applicant = null;
        if(auth()->user()->name){
            $current = Carbon::now();
            $this->data['unread'] = Applicant::where('status_id','=',1)
                                             ->get();
            $this->data['total'] = Applicant::get();
            $this->data['category'] = DB::table('applicant')
                                        ->select( DB::raw("count('applicant.status_id') as count"),'applicant_status.status')
                                        ->join('applicant_status','applicant.status_id','=','applicant_status.id')
                                        ->groupby('applicant_status.status')
                                        ->get();
            $this->data['today_unread'] = Applicant::whereBetween('created_at',[Carbon::now()->startOfDay(),Carbon::now()->endofDay()])
                                                   ->whereIn('status_id',[1])
                                                   ->get();
            $total = Applicant::join('applicant_status','applicant.status_id','=','applicant_status.id')
                              ->select('applicant_status.status','applicant.created_at')
                              ->whereBetween('applicant.created_at',[Carbon::now()->startOfDay(),Carbon::now()->endofDay()])
                              ->get();
            $applicant = $this->groupStatus($total);

            $bar = Applicant::join('applicant_status','applicant.status_id','=','applicant_status.id')
                            ->select('applicant_status.status','applicant.created_at')
                            ->get();
            $bar = $this->groupTime($bar);

            $recent = Applicant::join('vacancy_post','applicant.id_vacancy_post','=','vacancy_post.id')
                                ->select('applicant.*','vacancy_post.title')
                                ->where('applicant.created_at','>=',$current->subDay())
                                ->whereIn('status_id',[1])
                                ->orderBy('created_at','desc')
                                ->paginate(10);
            $this->data['bar'] = $bar;
            $this->data['applicant'] = $applicant;
            $this->data['recent'] = $recent;
    		return $this->render_view('pages.index');
    	}
    	else{
            return redirect('/sign-in');
        }
    }

    public function chart($timeOption){
        $applicant = null;
        if($timeOption == "1"){
            $current = Carbon::now();
            $total = Applicant::join('applicant_status','applicant.status_id','=','applicant_status.id')
            ->select('applicant_status.status','applicant.created_at')
            ->whereBetween('applicant.created_at',[Carbon::now()->startOfDay(),Carbon::now()->endofDay()])
            ->get();
            $applicant = $this->groupStatus($total);
        }
        else if($timeOption == "2"){
            $fromDate = Carbon::now()->subDays(7)->toDateString();
            $tillDate = Carbon::now()->toDateString();
            $total = Applicant::join('applicant_status','applicant.status_id','=','applicant_status.id')
            ->select('applicant_status.status','applicant.created_at')
            ->whereBetween('applicant.created_at', [$fromDate, $tillDate] )
            ->get();
            $applicant = $this->groupStatus($total);
        }
        else if($timeOption == "3"){
            $current = Carbon::now();
            $total = Applicant::join('applicant_status','applicant.status_id','=','applicant_status.id')
            ->select('applicant_status.status','applicant.created_at')
            ->whereMonth('applicant.created_at',$current->month)
            ->get();
            $applicant = $this->groupStatus($total);
        }
        else{
            $current = Carbon::now();
            $total = Applicant::join('applicant_status','applicant.status_id','=','applicant_status.id')
            ->select('applicant_status.status','applicant.created_at')
            ->get();
            $applicant = $this->groupStatus($total);
        }
        return $applicant;
    }
}
