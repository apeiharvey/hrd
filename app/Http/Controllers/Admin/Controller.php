<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $view_path = 'admin';
    public $temp = null;

    public function __construct(){
    	$this->data['view_path'] = $this->view_path;
    	$this->data['no'] = 1;
        $this->data['temp'] = $this->temp;
        $this->data['applicant'] = null;
        $this->data['bar'] = null;
        $applicant = null;
        $settings = Settings::get();
        foreach($settings as $key){
            $this->data[$key->name] = $key->value;
        }
        
    }

    public function render_view($view){
        if(Auth::check()){
            $this->data['menu'] = Session('menu');
        }
        $data = $this->data;
        return view($this->view_path.'.'.$view,$data);
    }
}