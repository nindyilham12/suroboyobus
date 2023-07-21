<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\ModelHelper;
use App\ModelNaikBus;
use App\ModelUser;
use App\ModelRole;

class HelperController extends Controller
{
     public function index(){
        if(!Session::get('login')){
        return view('login/formlogin');

        }else{
            $datas = ModelHelper::latest()->paginate(10);
            $params = [
                'helper' => $datas,
            ];
            return view('helper/home', $params);
        }
    }

    public function create()
    {
        $roles = ModelRole::all();
        $selectedRole = ModelUser::first()->role_id;
        return view('helper/formcreate', compact('roles', 'selectedRole'));
    }

    public function createPost(Request $request, ModelHelper $data)
    {
        $user = new ModelUser();

        $user->email = $request->input('email_helper');
        $user->password = $request->input('password_helper');
        $user->role_id = $request->input('role_id');
        
        $data->nama_helper = $request->input('nama_helper');
        $data->telp_helper = $request->input('telp_helper');
        
        $user->save();
        $data->user_id_helper = $user->id;
        $data->save();
        /*dd($user);*/
        return redirect('/homehelper')
                ->with('success','User created successfully');
    }

    public function show(ModelNaikBus $data, Request $request)
    {
        $idUserHelper = $request->get('user_id_helper');
        $data = ModelNaikBus::where(['user_id_helper' => $idUserHelper])->get();
        
        $params = [
            'data' => $data
        ];
        return view('helper/show',compact('data'));
    }

    public function edit(ModelHelper $data, $id)
    {
        $data = ModelHelper::find($id);
        return view('helper/formedit',compact('data'));
    }

    public function update(Request $request, ModelHelper $data, $id)
    {
        $data = ModelHelper::find($id);

            $data->nama_helper = $request->input('nama_helper');
            $data->telp_helper = $request->input('telp_helper');
            $data->save();
            return redirect('/homehelper')
                        ->with('success','User updated successfully');
    }

    public function delete(ModelHelper $data, $id)
    {   
        $data = ModelHelper::where('id_helper','=', $id)->first();
        $data->delete();
        ModelUser::where('user_id','=', $data->user_id)->delete();
                
        return redirect('/homehelper')->with('success','User deleted successfully');
    }
}
