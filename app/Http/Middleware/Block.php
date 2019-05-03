<?php

namespace App\Http\Middleware;

use Closure;

class Block
{
    public function handle($request, Closure $next){
    	if(auth()->check()){
    	}
    	else{
    		return redirect('/admin/sign-in');
    	}
    	return $next($request);
    }
}