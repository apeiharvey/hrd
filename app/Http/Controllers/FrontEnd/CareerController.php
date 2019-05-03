<?php

namespace App\Http\Controllers\FrontEnd;
use App;
use App\Models\CompanyValue;
use App\Models\Gallery;
use App\Models\Contents;
use App\Models\VacancyCategory;
use App\Models\Settings;
use App\Models\SocialMedia;
use App\Models\CompanyCategory;
use App\Models\CompanyPost;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\VacancyPost;
use App\Models\Applicant;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;

class CareerController extends Controller
{
    public function __construct(){
        $this->middleware('language');
        $this->data['socialmedia'] = SocialMedia::where('active','=','1')->orderBy('order')->get();
        $this->data['footer'] = Contents::where('name','footer_background')->first();
        parent::__construct();
    }
    
    public function index(){
        
        $companyvalue = CompanyValue::orderBy('order')->limit(5)->get();
        $contents = Contents::where('name','what_success')
                              ->orWhere('name','video_url')
                              ->orWhere('name','home_header')
                              ->orWhere('name','home_search_word_title')
                              ->orWhere('name','home_search_word_description')
                              ->orWhere('name','what_success_author')
                              ->orWhere('name','what_success_author_department')
                              ->get();


        foreach($contents as $key){
            $this->data[$key->name] = $key->value;
        }

        $this->data['title'] = trans('general.career')." - Kawanlama";
        $this->data['meta_description'] = trans('general.career')." - Kawanlama";
        $this->data['meta_keywords'] = "Career, Kawanlama, Available Jobs";
        //$this->data['breadcrumbs'] = [trans('general.home') => url('/')];
        $this->data['companyvalue'] = $companyvalue;
        $this->data['vacancycategory'] = VacancyCategory::where('active','=','1')->orderBy('order')->get();
    	
        return $this->render_view('pages.home');
    }

    public function contact(){
        $this->data['title'] = trans('general.contact-us')." - Kawanlama";
        $this->data['meta_description'] = "If you are looking for a new job with great experience then please contact us today.";

    	$this->data['contents'] = Contents::where('name','contact_us_header')->get()->first();

        $this->data['breadcrumbs'] = [trans('general.home') => url('/')];
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.contact-us'),url('contact-us'));

        $this->data['urlcompany'] = CompanyPost::select('title','url')->where('active','=','1')->orderBy('order')->get();
        return $this->render_view('pages.contact');
    }

    public function career(){
        $this->data['title'] = trans('general.career')." - Kawanlama";
        $this->data['vacancycategory'] = VacancyCategory::where('active','=','1')->orderBy('order')->get();

        $this->data['breadcrumbs'] = [trans('general.home') => url('/')];
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.career'),url('career'));
        
        return $this->render_view('pages.careers');
    }

    public function careerCategory($department){
        
        $vacancycategory = VacancyCategory::select('id','name')->where('category_alias',$department)->get()->first();
        $vacancypost = VacancyPost::join('vacancy_category','vacancy_category.id','vacancy_post.category_id')
                                  ->select('vacancy_post.title','vacancy_post.description','vacancy_post.post_alias','vacancy_category.category_alias')
                                  ->where('category_id',$vacancycategory->id)
                                  ->where('vacancy_post.active','=','1')
                                  ->orderBy('vacancy_post.order')
                                  ->paginate(12);

        $this->data['breadcrumbs'] = [trans('general.home') => url('/')];
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.career'),url('career'));
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],$vacancycategory->name,url("career/".$department));

        $this->data['vacancycategory'] = $vacancycategory;
        $this->data['vacancypost'] = $vacancypost;

        $this->data['title'] = $vacancycategory->name." - Kawanlama";
        
        $meta_description = $vacancycategory->name. " :";
        foreach($vacancypost as $key){
            $meta_description = $meta_description." ".$key->title." ,";
        }
        $meta_description = $meta_description." - Kawanlama";
        
        $this->data['meta_description'] = $meta_description;

        return $this->render_view('pages.categoryjob');
    }

    public function careerDetail($department,$jobDetail){
        
        $vacancycategory = VacancyCategory::select('id','name')->where('category_alias',$department)->get()->first();

        $vacancypost = VacancyPost::select('id','title','description','requirements','responsibilities','meta_title','meta_description','meta_keywords')
                                  ->where('post_alias',$jobDetail)
                                  ->first();

        $this->data['breadcrumbs'] = [trans('general.home') => url('/')];
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.career'),url('career'));
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],$vacancycategory->name,url("career/".$department));
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],$vacancypost->title,url('career/'.$department.'/'.$jobDetail));

    	$this->data['vacancypost'] = $vacancypost;

        

        $this->data['title'] = $vacancypost->meta_title;
        $this->data['meta_description'] = $vacancypost->meta_description;
        $this->data['meta_keywords'] = $vacancypost->meta_keywords;
        return $this->render_view('pages.applyjob');
    }

    public function searchCareer(Request $request){

        $this->data['title'] = trans('general.search')." - Kawanlama";
        $this->data['breadcrumbs'] = [trans('general.home') => url('/')];
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.search')." : ".$request->keyword, url('career-search')."?keyword=".$request->keyword);

        $keyword = $request->keyword;
        $vacancypost = VacancyPost::join('vacancy_category','vacancy_category.id','vacancy_post.category_id')
                                  ->select('vacancy_post.title','vacancy_post.description','vacancy_post.post_alias','vacancy_category.category_alias','vacancy_category.name')
                                  ->where('vacancy_post.title','like','%'.$keyword.'%')
                                  ->where('vacancy_post.active','=','1')
                                  ->orwhere('vacancy_post.description','like','%'.$keyword.'%')
                                  ->where('vacancy_post.active','=','1')
                                  ->orwhere('vacancy_category.name','like','%'.$keyword.'%')
                                  ->where('vacancy_post.active','=','1')
                                  ->orderBy('vacancy_post.order')
                                  ->get();
        $this->data['vacancypost'] = $vacancypost;

        return $this->render_view('pages.careersearch');
    }

    public function employeeActivity(Request $request){
        $gallery = Gallery::where('active','=','1')->orderBy('created_at','desc')->paginate(12);
        $this->data['testimonial'] = Testimonial::select('name','position','testimony')->where('active','=','1')->orderBy('order','asc')->limit(10)->get();
        //dd($gallery);
        if($request->page == null){
            $this->data['title'] = trans('general.employee-activity')." - Kawanlama";
            $this->data['meta_description'] = "- Kawanlama";
            $this->data['contents'] = Contents::where('name','gallery_header')->get()->first();
            $this->data['gallery'] = $gallery;

            $this->data['breadcrumbs'] = [trans('general.home') => url('/')];
            $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.employee-activity'),url('employee'));

            return $this->render_view('pages.employee');

        }else if($gallery->lastPage() > $request->page){
            $this->data['galleries'] = $gallery;
            $view = $this->render_view('component.employeeactivities');
            return ['content' => $view->render() , 'disabled' => false];
        }
        else{
           // dd($gallery);
            $this->data['galleries'] = $gallery;
            $view = $this->render_view('component.employeeactivities');
            return ['content' => $view->render() , 'disabled' => true];
        }
    }

    public function news(){                    
        $blogpost = BlogPost::join('blog_category','blog_category.id','=','blog_post.category_id')
                            ->select('blog_post.title','blog_post.thumbnail','blog_post.created_at','blog_post.title_alias','blog_post.view','blog_category.name_alias')
                            ->where('blog_post.active','=',1)
                            ->orderBy('created_at','desc')
                            ->paginate(12);
        $blogpost = $this->diffHumans($blogpost);

        $this->data['title'] = trans('general.news')." - Kawanlama";
        
        $this->data['categorytitle'] = "";
        $this->data['blogpostcategory'] = BlogCategory::select('name','name_alias')->where('active','=','1')->orderBy('order','asc')->get();

        $this->data['blogpost'] = $blogpost; 
        $this->data['breadcrumbs'] = [trans('general.home') => url('/')];
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.news'),url('blog'));

        return $this->render_view('pages.news');

    }
    public function newsCategory($category){
        $newscategory = ucwords(str_replace('-',' ',$category));
        
        $blogpost = BlogPost::join('blog_category','blog_category.id','=','blog_post.category_id')
                            ->select('blog_post.title','blog_post.thumbnail','blog_post.created_at','blog_post.title_alias','blog_post.view','blog_category.name_alias')
                            ->where('blog_category.name_alias','=',$category)
                            ->where('blog_post.active','=',1)
                            ->orderBy('created_at','desc')
                            ->paginate(12);
                            
        $blogpost = $this->diffHumans($blogpost);
        $this->data['categorytitle'] = " : ".$newscategory;
        $this->data['blogpost'] = $blogpost;
        $this->data['blogpostcategory'] = BlogCategory::select('name','name_alias')->where('active','=','1')->orderBy('order','asc')->get();

        $this->data['title'] = $newscategory." - Kawanlama";

        $this->data['breadcrumbs'] = [trans('general.home') => url('/')];
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.news'),url('blog'));
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],$newscategory,url('blog/'.$category));
        return $this->render_view('pages.news');
    }

    public function newsDetail($category,$id){
        $newscategory = ucwords(str_replace('-',' ',$category));

        $this->data['socialmediaread'] = SocialMedia::whereRaw("LOWER(`name`) = 'facebook'")
                                                    ->orWhereRaw("LOWER(`name`) = 'linked in'")
                                                    ->get();

        
        $blogpost = BlogPost::select('blog_post.*')
                            ->where('title_alias',$id)
                            ->first();

        $blogpost->view++;

        BlogPost::where('title_alias',$id)
                ->update(['view' => $blogpost->view]);

        $blogpost->datetime = str_replace("before","ago",$blogpost->created_at->diffForHumans(Carbon::now()));

       

        $this->data['read'] = $blogpost;

        $latest = BlogPost::join('blog_category','blog_category.id','=','blog_post.category_id')
                            ->select('blog_post.title','blog_post.thumbnail','blog_post.created_at','blog_post.title_alias','blog_post.view','blog_category.name_alias')
                            ->where('blog_post.id','!=',$blogpost->id)
                            ->where('blog_post.active','=','1')
                            ->orderBy('blog_post.created_at','desc')
                            ->limit(3)
                            ->get();

        $latest = $this->diffHumans($latest);

        $this->data['latest'] = $latest;

        $related = BlogPost::join('blog_category','blog_category.id','=','blog_post.category_id')
                            ->select('blog_post.title','blog_post.thumbnail','blog_post.created_at','blog_post.title_alias','blog_post.view','blog_category.name_alias')
                            ->where('blog_category.name_alias','=',$category)
                            ->where('blog_post.id','!=',$blogpost->id)
                            ->where('blog_post.active','=','1')
                            ->orderBy('blog_post.created_at','desc')
                            ->limit(3)
                            ->get();
                            //dd($related);
        $related = $this->diffHumans($related);
        

        $this->data['related'] = $related;

        $this->data['title'] = $blogpost->meta_title;
        $this->data['meta_description'] = $blogpost->meta_description;
        $this->data['meta_keywords'] = $blogpost->meta_keywords;

        $this->data['breadcrumbs'] = [trans('general.home') => url('/')];
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.news'),url('blog'));
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],$newscategory,url('blog/'.$category));
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],$blogpost->title,url('blog/'.$category.'/'.$id));

        return $this->render_view('pages.read');
    }

    public function aboutUs(){
        if(App::getLocale() == 'en'){
            $this->data['contents'] = Contents::where('name','about_us_en')->get()->first();
        }else{
            $this->data['contents'] = Contents::where('name','about_us')->get()->first();
        }
        $this->data['title'] = trans('general.about-us')." - Kawanlama";
        $this->data['meta_description'] = "Kawan Lama Group has been established since 1955 and has already had several business sectors engaged in Retail, Industrial, Food and Beverage, Service, Property, and E-commerce.";
        
        $this->data['companycategory'] = CompanyCategory::where('active','=','1')->orderBy('order')->get();
        $this->data['breadcrumbs'] = [trans('general.home') => url('/')];
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.about-us'),url('about-us'));
        
        return $this->render_view('pages.aboutus');
    }

    public function apply(){
        
        $this->data['breadcrumbs'] = [trans('general.home') => url('/')];
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.career'),url('career'));
        $this->data['breadcrumbs'] = array_add($this->data['breadcrumbs'],trans('general.apply'),url('career/apply'));

        $this->data['title'] = trans('general.apply')." - Kawanlama";

        return $this->render_view('pages.apply');
    }

    public function diffHumans($latest){
        $i = 0;
        foreach($latest as $key){
            $latest[$i]->datetime = str_replace("before","ago",$key->created_at->diffForHumans(Carbon::now()));   
            $i++;
        }
        
        return $latest;
    }

}

?>