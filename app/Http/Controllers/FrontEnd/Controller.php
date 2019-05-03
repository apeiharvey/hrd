<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Settings;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $view_path = 'frontend';
    public $data = [];
    public function __construct(){
    	$this->data['view_path'] = $this->view_path;
        $settings = Settings::get();
        foreach($settings as $key){
            $this->data[$key->name] = $key->value;
        }
        //dd($this->data['web_phone']);
    }

    public function render_view($view){
    	$data  = $this->data;
        if($this->data['maintenance'] == 1){
            return view($this->view_path.'.maintenance.index');
        }else{
    	   return view($this->view_path.'.'.$view,$data);
        }
    }
}
