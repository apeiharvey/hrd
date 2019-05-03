<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Email;
use App\Models\EmailTemplate;
use Mail;
use DB;
use App\Mail\InvitationEmail;

class MailController extends Controller {

	public function index(request $request){
      $id = explode(";", $request->id);
      $content = $request->content;
      $data = [];
      $subject = $request->subject;
      $data['id'] = array_filter($id);
      $template = EmailTemplate::where('id','=',$request->template)->first();
      $i = 0;
      if($content == "" || $template == ""){
        return 'empty';
      }
      if($data['id'] && $content && $template){
         foreach($data['id'] as $key){
            $tempcontent = null;
            $applicant = DB::table('applicant')
                           ->join('vacancy_post','applicant.id_vacancy_post','=','vacancy_post.id')
                           ->join('applicant_status','applicant.status_id','=','applicant_status.id')
                           ->select('applicant.*','vacancy_post.title')
                           ->where('applicant.id','=',$key)
                           ->first();
            $tempcontent    = str_replace('{name}',$applicant->firstname.' '.$applicant->lastname, $content);
            $tempcontent    = str_replace('{job_title}',$applicant->title, $tempcontent);
            Mail::to($applicant->email)->send(new InvitationEmail($applicant,$tempcontent,$template->name));
         }
        return 'success';
      }
      else{
        return 'fail';
      }
   }
}