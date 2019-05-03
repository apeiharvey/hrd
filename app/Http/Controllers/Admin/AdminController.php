<?php
namespace App\Http\Controllers\Admin;
use illuminate\Http\request;
use App\Models\Users;
use App\Models\Menu;
use App\Models\UsersAccess;
use App\Models\UsersAccessMenu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Image;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        // $this->middleware('role');
        parent::__construct();
    }

    public function index(request $request){
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['name','email']) ? $sort : 'name';
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
        if($request->has('search')){
            $this->data['users_access'] = DB::table('user_access')
                                     ->where('name','like','%'.$request->search.'%')
                                     ->orderBy($sort,$order)
                                     ->paginate(10);
        }
        else{
            $this->data['users_access'] = DB::table('user_access')->orderBy($sort,$order)->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.admin.index');
    }

    public function hasPrivilege($user_access_menu,$menu){
        for($j=0;$j<$user_access_menu->count();$j++){
            if($user_access_menu[$j]->menu_id == $menu->id){
                return 1;
            }
        }
        return 0;
    }

    public function create(){
        return $this->render_view('pages.preferences.settings.admin.insert');
    }

    public function store(request $request){
        $user_access = new UsersAccess;
        $user_access->name = $request->name;
        $user_access->active = $request->active;
        if($user_access->name && $user_access->active){
            $user_access->save();
            $request->session()->flash('message', 'Data Successfully Submited!');
            return redirect()->back();
        }
        else{
            $request->session()->flash('message_failed', 'All Data Must Be Filled!');
            return redirect()->back();
        }
    }

    public function show($id){
        $menu = Menu::orderBy('id','asc')->get();
        $user_access_menu = UsersAccessMenu::where('user_access_id','=',$id)
                                            ->orderBy('menu_id','asc')
                                            ->get();
        for($i = 0; $i < $menu->count(); $i++){
            $menu[$i]->active = $this->hasPrivilege($user_access_menu,$menu[$i]);
        }
        $this->data['menu_privilege'] = $menu;
        $this->data['id'] = $id;
        return $this->render_view('pages.preferences.settings.admin.set-privilege');
    }

    public function update(request $request,$id){
        $menu[] = $request->id;
        $user_access = $request->user_access;
        $active = $request->active;
        $usermenu= UsersAccessMenu::where('user_access_id','=',$user_access)->get();
        if(count($usermenu) != 0){
            $usermenu = UsersAccessMenu::where('user_access_id','=',$user_access)->delete();
            for($i=0;$i<count($menu[0]);$i++){
                foreach($menu as $value){
                    $usermenu = new UsersAccessMenu;
                    $usermenu->menu_id = $value[$i];
                    $usermenu->user_access_id = $user_access;
                    $usermenu->save();
                }
            }
            $request->session()->flash('message', 'Data Successfully Updated!');
            return redirect()->back();
        }
        else{
            for($i=0;$i<count($menu[0]);$i++){
                foreach($menu as $value){
                    $usermenu = new UsersAccessMenu;
                    $usermenu->menu_id = $value[$i];
                    $usermenu->user_access_id = $user_access;
                    $usermenu->save();
                }
            }
            $request->session()->flash('message_failed', 'Sorry, There Is an Error While Updating Data.');
            return redirect()->back();
        }
    }

    public function active(request $request){
        $id = $request->id;
        $active = $request->active;
        if($id){
            $useraccess = UsersAccess::find($id);
            $useraccess->active = $active;
            $useraccess->save();
            $request->session()->flash('message', 'User Access updated!');
            return redirect()->back();
        }
        else{
            $request->session()->flash('message_failed', 'Sorry, There is an error while updating the data.');
            return redirect()->back();
        }
    }
}
