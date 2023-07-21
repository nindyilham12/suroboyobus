<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\ModelBankSampah;
use App\ModelTukarSampah;
use App\ModelUser;
use App\ModelRole;
class BankSampahController extends Controller
{
    public function index(){
        if(!Session::get('login')){
        return view('login/formlogin');

        }else{
            $datas = ModelBankSampah::latest()->paginate(6);
            $params = [
                'banksampah' => $datas
            ];
            
            return view('banksampah/home', $params);
        }
    }

    public function create()
    {
        $roles = ModelRole::all();
        $selectedRole = ModelUser::first()->role_id;
        return view('banksampah/formcreate', compact('roles', 'selectedRole'));
    }

    public function createPost(Request $request, ModelBankSampah $data)
    {
        $user = new ModelUser();

        $user->email = $request->input('email_banksampah');
        $user->password = $request->input('password_banksampah');
        $user->role_id = $request->input('role_id');
        
        $data->nama_banksampah = $request->input('nama_banksampah');
        $data->alamat_banksampah = $request->input('alamat_banksampah');
        $data->telp_banksampah = $request->input('telp_banksampah');
        $data->sticker_banksampah = $request->input('sticker_banksampah');
        $data->latitude = $request->input('latitude');
        $data->longtitude = $request->input('longtitude');

        $user->save();
        $data->user_id_banksampah = $user->id;
        $data->save();
        return redirect('/homesampah')
            ->with('success','Bank Sampah created successfully');
    }

    public function show(Request $request)
    {   
        $idUserBankSampah = $request->get('user_id_banksampah');
        $data = ModelTukarSampah::where(['user_id_banksampah' => $idUserBankSampah])->get();
        
        $params = [
            'data' => $data
        ];
        return view('banksampah/show',$params);
    }

    public function edit(ModelBankSampah $data, $id)
    {
        $data = ModelBankSampah::find($id);
        return view('banksampah/formedit',compact('data'));
    }

    public function update(Request $request, ModelBankSampah $data, $id)
    {
        $data = ModelBankSampah::find($id);
        
            $data->nama_banksampah = $request->input('nama_banksampah');
            $data->alamat_banksampah = $request->input('alamat_banksampah');
            $data->telp_banksampah = $request->input('telp_banksampah');
            $data->sticker_banksampah = $request->input('sticker_banksampah');
            $data->latitude = $request->input('latitude');
            $data->longtitude = $request->input('longtitude');
            $data->save();
            return redirect('/homesampah')
                        ->with('success','User updated successfully');
    }

    public function delete(ModelBankSampah $data, $id)
    {
        $data = ModelBankSampah::where('id_banksampah','=', $id)->first();
        $data->delete();
        ModelUser::where('user_id','=', $data->user_id)->delete();
  
        return redirect('/homesampah')
                        ->with('success','User deleted successfully');
    }
}
