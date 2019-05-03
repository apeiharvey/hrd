<?php

namespace App\Http\Middleware;

use Closure;
use App;

class Language
{
    public function handle($request, Closure $next){
    	$language 	= $request->cookie('language');
    	if(!$language){
	        $response = $next($request);
	        App::setLocale('id');
	        return $response->withCookie(cookie()->forever('language', 'id'));
    	}else{
    		App::setLocale($language);
	    	return $next($request);
    	}
    }
}