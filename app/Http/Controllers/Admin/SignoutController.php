<?php

namespace App\Http\Controllers\Admin;
use App\Models\Users;
use Session;
use illuminate\Http\request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SignoutController extends Controller
{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        Auth::logout();
        return redirect('/admin');
    }
}