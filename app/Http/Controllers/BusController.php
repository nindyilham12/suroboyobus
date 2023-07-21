<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\ModelBus;

class BusController extends Controller
{
    public function index(){

        if(!Session::get('login')){
        return view('login/formlogin');

        }else{
            $datas = ModelBus::latest()->paginate(5);
            $params = [
                'bus' => $datas
            ];
            return view('bus/home', $params);
        }
    }

    public function create()
    {
        return view('bus/formcreate');
    }

    public function createPost(Request $request, ModelBus $data)
    {
            $data->nama_bus = $request->input('nama_bus');
            $data->tipe_bus = $request->input('tipe_bus');
            $data->tahun_bus = $request->input('tahun_bus');
            $data->warna_bus = $request->input('warna_bus');
            $data->platnomor_bus = $request->input('platnomor_bus');
            $data->pengguna = $request->input('pengguna');
            $data->save();
            return redirect('/homebus')
                        ->with('success','User created successfully');
    }

    public function show(ModelBus $data, $id)
    {
        $data = ModelBus::find($id);

        return view('bus/show',compact('data'));
    }

    public function edit(ModelBus $data, $id)
    {
        $data = ModelBus::find($id);
        return view('bus/formedit',compact('data'));
    }

    public function update(Request $request, ModelBus $data, $id)
    {
        $data = ModelBus::find($id);

            $data->nama_bus = $request->input('nama_bus');
            $data->tipe_bus = $request->input('tipe_bus');
            $data->tahun_bus = $request->input('tahun_bus');
            $data->warna_bus = $request->input('warna_bus');
            $data->platnomor_bus = $request->input('platnomor_bus');
            $data->pengguna = $request->input('pengguna');
            $data->save();
            return redirect('/homebus')
                        ->with('success','User updated successfully');
    }

    public function delete(ModelBus $data, $id)
    {
        $data = ModelBus::find($id);
        $data->delete();
  
        return redirect('/homebus')
                        ->with('success','User deleted successfully');
    }
}
