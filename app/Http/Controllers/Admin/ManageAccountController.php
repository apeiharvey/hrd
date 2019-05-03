<?php
namespace App\Http\Controllers\Admin;
use illuminate\Http\request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Image;
use Session;

class ManageAccountController extends Controller
{
    public function __construct(){
        $this->middleware('block');
        $this->middleware('role');
    	parent::__construct();
    }

    public function index(){
        $id=auth()->user()->id;
        $this->data['users'] = Users::find($id);
        return $this->render_view('pages.preferences.settings.manage-account.index');
    }

    public function update(request $request, $id){
        $this->data['users'] = Users::find($id);
        $this->data['users']->name = $request->name;
        if($request->password && $request->password_confirmation){
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
