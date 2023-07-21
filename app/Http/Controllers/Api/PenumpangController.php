<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\ModelPenumpang;
use App\ModelBankSampah;
use App\ModelTukarSampah;
use App\ModelNaikBus;
use App\ModelUser;
use App\Http\Controllers\Controller;

class PenumpangController extends Controller
{
    //data untuk halaman profile dan detail sticker penumpang
    public function profile(Request $request)
    {	
    	$userId = $request->input('user_id');
        if(is_null($userId)){
            $response = [
                    'code' => 400,
                    'message' => 'Parameter tidak boleh kosong',
                    'success' => false,
                    
                ];
            return response()->json($response);
        }

        $penumpang = ModelPenumpang::where(['user_id_penumpang' => $userId])->first();
        $penumpangData = $penumpang;
        $penumpangData = collect($penumpangData)->toArray();

        $userData = $penumpang->get_user;

        $response = [
                    'code' => 200,
                    'message' => 'Get Data Berhasil',
                    'success' => true,
                    'data' => [
                        'penumpang' => $penumpangData,
                        'user' => $userData
                    ]
                    
                ];
            return response()->json($response);
    }

    //data untuk halaman history tukarsampah
    public function historytukarsampah(Request $request){
        $userId = $request->input('user_id');
        if(is_null($userId)){
            $response = [
                    'code' => 400,
                    'message' => 'Parameter tidak boleh kosong',
                    'success' => false,
                    
                ];
            return response()->json($response);
        }

        $tukarsampahData['user_id_penumpang']  = $request->request->get('user_id_penumpang');
        $tukarsampahData = ModelTukarSampah::where(['user_id_penumpang' => $userId])
        ->with(['get_banksampah'])
        ->get();

        $response = [
                    'code' => 200,
                    'message' => 'Get Data Berhasil',
                    'success' => true,
                    'data' => $tukarsampahData
                ];
            return response()->json($response);
    }

    public function historynaikbus(Request $request){
        $userId = $request->input('user_id');
        if(is_null($userId)){
            $response = [
                    'code' => 400,
                    'message' => 'Parameter tidak boleh kosong',
                    'success' => false,
                    
                ];
            return response()->json($response);
        }

        $naikbusData['user_id_penumpang']  = $request->request->get('user_id_penumpang');
        $naikbusData = ModelNaikBus::where(['user_id_penumpang' => $userId])
        ->with(['get_helper'])
        ->get();

        $response = [
                    'code' => 200,
                    'message' => 'Get Data Berhasil',
                    'success' => true,
                    'data' => $naikbusData,
                ];
            return response()->json($response);
    }

}
