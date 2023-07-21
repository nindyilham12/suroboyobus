<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\ModelUser;
use App\ModelRole;

class UserController extends Controller
{
    public function index(){
        if(!Session::get('login')){
        return view('login/formlogin');

        }else{
            $users = ModelUser::latest()->paginate(5);
            $params = [
                'users' => $users
            ];
            return view('user/home',$params);
        }
    }

    public function create()
    {
        $roles = ModelRole::all();
        $selectedRole = ModelUser::first()->role_id;

        return view('user/formcreate', compact('roles', 'selectedRole'));
    }

    public function createPost(Request $request, ModelUser $user)
    {
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->role_id = $request->input('role_id');
            $user->save();
            return redirect('/homeuser')
                        ->with('success','Admin created successfully');
    }

    public function show(ModelUser $user, $id)
    {
        $user = ModelUser::find($id);
        return view('user/show',compact('user'));
    }

    public function edit(ModelUser $user, $id)
    {
        $user = ModelUser::find($id);
        return view('user/formedit',compact('user'));
    }

    public function update(Request $request, ModelUser $user, $id)
    {
        $user = ModelUser::find($id);

            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->save();
            return redirect('/homeuser')
                        ->with('success','User updated successfully');
    }

    public function delete(ModelUser $user, $id)
    {
        $user = ModelUser::find($id);
        $user->delete();
  
        return redirect('/homeuser')
                        ->with('success','User deleted successfully');
    }
}
