<?php

namespace App\Http\Controllers\FrontEnd;
use App;
use App\Models\CompanyValue;
use App\Models\CompanyPost;
use App\Models\VacancyPost;
use App\Models\Applicant;
use App\Models\Gallery;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Storage;
use DB;
use Mail;
use Carbon\Carbon;
use App\Mail\SuccessApply;


class AjaxController extends Controller
{
    public function __construct(){
        parent::__construct();
    }

    /*public function showDetailCorValue($id){
        $detailcorvalue = CompanyValue::select("content")
                                                    ->where('id',$id)
                                                    ->get()
                                                    ->first();
        $split_detailcorvalue = explode(",",$detailcorvalue->content);
        $i = 0;
        foreach($split_detailcorvalue as $key){
            $strlen = strlen($key)-1;
            dd($strlen);
            $split_detailcorvalue[$i] = "<div><b>".substr($key,0,1)."</b>".substr($key,1,$strlen)."</div>";
            
            $i++;
        }
        $this->data['detailcorvalue'] = $split_detailcorvalue;

    	return $this->render_view('component.detailcorvalue');
    }*/

    public function showOurCompanies($id){
        $companypost = CompanyPost::join('company_category','company_category.id','=','company_post.category_id')
                                  ->select('company_post.title','company_post.thumbnail','company_post.description','company_post.description_eng')
                                  ->where('company_post.category_id',$id)
                                  ->where('company_post.active','=','1')
                                  ->orderBy('company_post.order')
                                  ->get();
        $this->data['ourcompanies'] = $companypost;

        return $this->render_view('component.ourcompanies');
    }


    public function showDetailVacancy($id){
        $vacancypost = VacancyPost::join('vacancy_category','vacancy_category.id','vacancy_post.category_id')
                                  ->select('vacancy_post.title','vacancy_post.responsibilities','vacancy_post.post_alias','vacancy_category.category_alias','vacancy_post.order','vacancy_category.name')
                                  ->where('vacancy_post.category_id',$id)
                                  ->where('vacancy_post.active','=','1')
                                  ->orderBy('vacancy_post.order')
                                  ->get();
        
        //dd($vacancypost);
        $n = 0;
        foreach($vacancypost as $key){
            //dd($key);
            $responsibilities = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $key->responsibilities);
            //dd($responsibilities);
            //dd("ADA");
            $responsibilities = explode('<li>',$responsibilities);
            //dd($responsibilities);
            //if($n == 1)
            //dd($vacancypost[$n]->responsibilities);
            //dd($responsibilities);
            $vacancypost[$n]->responsibilities = "";
            
            //dd($key);
            for($i = 0; $i < 2; $i++){
                if($i > 0){
                    $responsibilities[$i] = str_replace('</li>','',$responsibilities[$i]);
                    //dd($responsibilities[$i]);
                    $vacancypost[$n]->responsibilities = $vacancypost[$n]->responsibilities.$responsibilities[$i].'<br />';
                    //dd($responsibilities[$i]);
                    //dd($vacancypost[$n]->responsibilities);
                    //dd($responsibilities);
                }
            }
            //dd($vacancypost[$n]->responsibilities);
            $n++;
        }
        //dd($vacancypost);
        //dd(array_splice($a,0,1));
        if($vacancypost->count()){
            //dd($vacancypost);
            $this->data['vacancypost'] = $vacancypost;
            return $this->render_view('component.detailvacancy');
        }
        else{
            return "kosong";
        }
        
    }

    public function changeLanguage($id){
        if($id == 'id'){
            App::setLocale($id);
            return redirect()->back()->withCookie(cookie()->forever('language', 'id'));
        }else if($id == 'en'){
            App::setLocale($id);
            return redirect()->back()->withCookie(cookie()->forever('language', 'en'));
        }else{
            return "GAGAL";
        }
    }

    public function applyJob(Request $request){
        $now = Carbon::now()->toDateTimeString();
        $startDate = Carbon::now()->subMonth()->toDateTimeString();
        $applicant_check = Applicant::join('vacancy_post','vacancy_post.id','=','applicant.id_vacancy_post')
                                    ->join('vacancy_category','vacancy_category.id','=','vacancy_post.category_id')
                                    ->select(DB::raw('count(*) as count'))
                                    ->where('applicant.email','=',$request->email)
                                    ->where('applicant.phone','=',$request->phone)
                                    ->whereBetween('applicant.created_at',[$startDate,$now])
                                    ->where('applicant.id_vacancy_post','=',$request->vacancyID)
                                    ->first();
        //dd($applicant_check);
        //dd($applicant_check->count);
        if($applicant_check->count < 1){

            $applicant = new Applicant;
            $applicant->firstname = $request->firstName;
            $applicant->lastname = "";
            $applicant->email = $request->email;
            $applicant->phone = $request->phone;
            $applicant->id_vacancy_post = $request->vacancyID;
            $applicant->url = "";
            $applicant->pengalaman = "";
            $applicant->resume = $request->firstName.'-'.date('Y-m-d-H-i-s').'.pdf';
            
            if($request->lastName != null){
                $applicant->lastname = $request->lastName;
            }
            if($request->website != null){
                $applicant->url = $request->website;
            }
            if($request->experience != null){
                $applicant->pengalaman = $request->experience;
            }

            $saved = $applicant->save();
            if($saved){
                $original_name = $request->firstName.'-'.date('Y-m-d-H-i-s').'.pdf';
                $file_path = 'uploads/';

                $oldfile = $request->file;
                $oldfile->move($file_path,$original_name); 
                //SEND EMAIL

                Mail::to($applicant->email)->send(new SuccessApply($applicant));
                return 'success';
            }else{
                return 'fail';
            }
        }else{
            return 'twice';
        }
    }

}

?>