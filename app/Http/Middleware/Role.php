<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Role
{
    public function handle($request, Closure $next){
    	$path = explode('/', $request->path());
    	$menu = Session('menu');
    	$flag = false;
    	foreach ($menu as $value){
    		if(in_array('/'.$path[1], $value['url'])){
    			$flag = true;
    		}
    	}
    	if($flag == false){
    		return redirect()->back();
    	}
    	return $next($request);
    }
}