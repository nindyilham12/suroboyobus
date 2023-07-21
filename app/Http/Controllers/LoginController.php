<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\ModelUser;


class LoginController extends Controller
{
    public function index()
    {
      if(!Session::get('login')){
        return redirect('login')->with('alert','You Must Login');
      }
      else{
        return redirect('/homeweb');
      }
    }

    public function login()
    {
        return view('login/formlogin');
    }

    public function loginPost(Request $request)
    {
      $email = $request->email;
      $password = $request->password;
      $data = ModelUser::where('email',$email)->first();
      if(!is_null($data)){ //apakah email ada atau tidak
        if($password==$data->password){

          if($data->role_id==1){
            Session::put('id',$data->id);
            Session::put('name',$data->name);
            Session::put('email',$data->email);
            Session::put('login',TRUE);
            return redirect('/homelogin');
          }else{
            return redirect('login')->with('alert', 'Akun tidak bisa mengakses');
          }
        }else{
          return redirect('login')->with('alert','Password atau Email, Salah !'.Hash::check($password,$data->password));
        }
      }else{
        return redirect('login')->with('alert','Password atau Email, Salahhh!');
      }
    }

    public function logout()
    {
      Session::flush();
      return redirect('login')->with('alert','Kamu sudah logout');
    }
}
