<?php
namespace App\Http\Controllers\Admin;
use illuminate\Http\request;
use App\Models\Users;
use App\Models\UsersAccess;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Image;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(request $request){
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['name','email']) ? $sort : 'name';
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
        if($request->has('search')){
            $this->data['users'] = DB::table('users')
                                     ->where('name','like','%'.$request->search.'%')
                                     ->orWhere('email','like','%'.$request->search.'%')
                                     ->orderBy($sort,$order)
                                     ->paginate(10);
        }
        else{
            $this->data['users'] = DB::table('users')->orderBy($sort,$order)->paginate(10);
        }
        $this->data['order'] = $order;
        return $this->render_view('pages.preferences.settings.users.index');
    }

    public function create(){
        $this->data['useraccess'] = UsersAccess::get();
        return $this->render_view('pages.preferences.settings.users.insert');
    }

    public function store(request $request){
        $users = new Users;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->user_access = $request->user_access;
        if($request->password && $request->password_confirmation){
            $this->validate($request,['password' => 'min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/|confirmed']);
            if($request->password == $request->password_confirmation){
                $users->password = Hash::make($request->password);
            }
            else{
                $request->session()->flash('message_password', 'Password did not match!');
                return redirect()->back();
            }
        }
        if($users->name && $users->email && $users->password){
            $users->save();
            $request->session()->flash('message', 'Data Successfully Submited!');
            return redirect()->back();
        }
        else{
            $request->session()->flash('message_failed', 'All Data Must Be Filled!');
            return redirect()->back();
        }
    }

    public function show($id)
    {   
        $this->data['useraccess'] = UsersAccess::get();
        $this->data['users'] = Users::find($id);
        return $this->render_view('pages.preferences.settings.users.update');
    }

    public function update(request $request, $id){
        $this->data['users'] = Users::find($id);
        $this->data['users']->name = $request->name;
        $this->data['users']->user_access = $request->user_access;
        if($request->password && $request->password_confirmation){
            $this->validate($request,['password' => 'min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/|confirmed']);
            if($request->password == $request->password_confirmation){
                $this->data['users']->password = Hash::make($request->password);
            }
            else{
                $request->session()->flash('message_password', 'Password did not match!');
                return redirect()->back();
            }
        }
        $this->data['users']->save();
        $request->session()->flash('message', 'Data Successfully Updated!');
    	return redirect()->back();
    }

    public function destroy(request $request, $id){
        $this->data['user'] = Users::find($id);
        $this->data['user']->delete();
        $request->session()->flash('message_delete', 'Data Successfully Deleted!');
        return redirect()->back();
    }
}
