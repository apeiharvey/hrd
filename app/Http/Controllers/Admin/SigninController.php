<?php

namespace App\Http\Controllers\Admin;
use App\Models\Users;
use App\Models\UsersAccess;
use App\Models\Menu;
use Session;
use illuminate\Http\request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SigninController extends Controller
{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->data['users'] = Users::get();
        return $this->render_view('pages.sign-in.index');
    }
    public function sign(request $request){
    	$email = $request->email;
    	$password = $request->password;
    	$result_login = false;
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            if(Auth::attempt(['email' => $email, 'password' => $password])){
                $result_login = true;
                $user = Users::where('email','=',$email)->first();
                $useraccess = Users::join('user_access','users.user_access','=','user_access.id')
                                   ->select('user_access.active')
                                   ->where('user_access.id','=',$user->user_access)
                                   ->first();
                if($useraccess->active == 1){
                    $temp = [];
                    $this->data['menu'] = Menu::join('user_access_menu','menu.id','=','user_access_menu.menu_id')
                                                ->join('user_access','user_access.id','=','user_access_menu.user_access_id')
                                                ->select('user_access_menu.*','menu.menu','menu.alias','menu.menu_alias','menu.id','menu.icon')
                                                ->where('menu.menu_id','=',0)
                                                ->where('user_access_menu.user_access_id','=',auth()->user()->user_access)
                                                ->get();
                    for($i=0;$i<$this->data['menu']->count();$i++){
                        $array = [];
                        $temp[$this->data['menu'][$i]->menu]['submenu'] = Menu::join('user_access_menu','menu.id','=','user_access_menu.menu_id')
                                    ->join('user_access','user_access.id','=','user_access_menu.user_access_id')
                                    ->where('menu.menu_id','=',$this->data['menu'][$i]->id)
                                    ->where('user_access_menu.user_access_id','=',auth()->user()->user_access)
                                    ->get();
                        $temp[$this->data['menu'][$i]->menu]['url'] = Menu::join('user_access_menu','menu.id','=','user_access_menu.menu_id')
                                    ->join('user_access','user_access.id','=','user_access_menu.user_access_id')
                                    ->select('menu.menu_alias')
                                    ->where('menu.menu_id','=',$this->data['menu'][$i]->id)
                                    ->where('user_access_menu.user_access_id','=',auth()->user()->user_access)
                                    ->get();
                        foreach ($temp[$this->data['menu'][$i]->menu]['url'] as $key) {
                            array_push($array,$key->menu_alias);
                        }
                        $temp[$this->data['menu'][$i]->menu]['url'] = $array;
                        $temp[$this->data['menu'][$i]->menu]['detail'] = $this->data['menu'][$i];
                    }
                    Session::put('menu',$temp);
                    return redirect('/admin');
                }
                else{
                    $request->session()->flash('message', "Sorry, There is a problem while you're trying to login. Please contact Admin.");
                    return redirect()->back();
                }
                
            }
            else{
                $request->session()->flash('message', "Email and Password didn't match!");
                return redirect()->back();
            }
        }
    	else{
            $request->session()->flash('message', 'Invalid Email Format!');
            return redirect()->back();
        }
    }
}