<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\ModelPenumpang;

class PenumpangController extends Controller
{
    public function index(){
     	if(!Session::get('login')){
        return view('login/formlogin');

        }else{
            $datas = ModelPenumpang::latest()->paginate(5);
            $params = [
                'penumpang' => $datas
            ];
            return view('penumpang/home', $params);
        }
    }

    public function show(ModelPenumpang $data, $id)
    {
        $data = ModelPenumpang::find($id);

        return view('penumpang/show',compact('data'));
    }
}
