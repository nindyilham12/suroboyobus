<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\ModelPenumpang;
use App\ModelUser;
use App\ModelRole;
use Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //masuk ke tabel user dan penumpang
    public function register(Request $request) 
    {   
        $user = new ModelUser();
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->role_id = 4;
        
        $data = new ModelPenumpang();
        $data->nama_penumpang = $request->input('nama_penumpang');
        $data->telp_penumpang = $request->input('telp_penumpang');

        $user->save();
        $data->user_id_penumpang = $user->id;
        $data->save();

        $response = [
                'code' => 200,
                'message' => 'Register Berhasil',
                'success' => true,
            ];
            return response()->json($response);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => 404,
                'message' => 'Parameter belum lengkap',
                'data' => null
            ];

            return response()->json($response);
        }

        $userData['email'] = $request->request->get('email');
        $userData['password'] = $request->request->get('password');
        $userData['role_id'] = $request->request->get('role_id');

        $user = ModelUser::where(['email' => $userData['email'], 'role_id' => $userData['role_id']])
        		->first();
        if(is_null($user)){
            $response = [
                'code' => 404,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ];
            return response()->json($response);
        }

        if($user->password != $userData['password']){
             $response = [
                    'code' => 400,
                    'message' => 'Password tidak sama',
                    'data' => null
                ];
            return response()->json($response);   
        }

        $response = [
                    'code' => 200,
                    'message' => 'Login berhasil',
                    'success' => true,
                    'data' => $user
                ];
            return response()->json($response);
    }
}
