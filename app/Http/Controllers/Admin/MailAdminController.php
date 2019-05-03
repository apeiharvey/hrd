<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Mail;
use DB;
use App\Models\Applicant;
use App\Mail\DailyMail;
use Carbon\Carbon;

class MailAdminController extends Controller {

	public function index(request $request){
    $this->data['today_unread'] = Applicant::whereBetween('created_at',[Carbon::now()->startOfDay(),Carbon::now()->endofDay()])
                                           ->whereIn('status_id',[1])
                                           ->get();
    $this->data['total_unread'] = Applicant::where('status_id','=',1)
                                          ->get();
    $today_unread = $this->data['today_unread']->count();
    $total_unread = $this->data['total_unread']->count();
    Mail::to($this->data['web_email'])->send(new DailyMail($today_unread,$total_unread));
    return "success";   
 }
}