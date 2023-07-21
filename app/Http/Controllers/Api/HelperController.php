<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\ModelHelper;
use App\ModelNaikBus;
use App\ModelBus;
use App\ModelPenumpang;
use App\ModelUser;
use Validator;
use App\Http\Controllers\Controller;

class HelperController extends Controller
{

    //halaman get sticker
    public function naikbus(Request $request)
    {   
        $naikbusData = new ModelNaikBus();
        $naikbusData->user_id_penumpang = $request->input('user_id_penumpang'); 
        $naikbusData->user_id_helper = $request->input('user_id_helper');
        $naikbusData->sticker_naikbus = $request->input('sticker_naikbus');

        $helperData = ModelHelper::where(['user_id_helper' => $request->input('user_id_helper')])->first();
        $penumpangData = ModelPenumpang::where(['user_id_penumpang' => $request->input('user_id_penumpang')])->first();

        if($penumpangData->sticker_penumpang >= $naikbusData->sticker_naikbus){
            $penumpangData->sticker_penumpang = $penumpangData->sticker_penumpang - $request->input('sticker_naikbus');
            $helperData->sticker_helper = $helperData->sticker_helper + $request->input('sticker_naikbus');

            $naikbusData->save();
            $naikbusData->datetime = $naikbusData->created_at;
            $penumpangData->save();
            $helperData->save();
            $response = [
                    'code' => 200,
                    'message' => 'Get Sticker Berhasil',
                    'success' => true,
                    'data' => ['naikbus'=> $naikbusData, 'penumpang' => $penumpangData, 'helper' => $helperData] 
                ];
        }else{
            $response = [
                    'code' => 300,
                    'message' => 'Sticker Penumpang Tidak Mencukupi',
                    'success' => false,
                    'data' => null 
                ];
        }
        return response()->json($response);
    }

    //halaman history
    public function historynaikbus(Request $request)
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

        $naikbusData['user_id_helper']  = $request->request->get('user_id_helper');
        $naikbusData = ModelNaikBus::where(['user_id_helper' => $userId])
        ->with(['get_penumpang'])
        ->get();

        $response = [
                    'code' => 200,
                    'message' => 'Get Data Berhasil',
                    'success' => true,
                    'data' => $naikbusData
                ];
            return response()->json($response);
    }

    //data untuk halaman profile dan detail sticker
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

        $helper = ModelHelper::where(['user_id_helper' => $userId])->first();
        $helperData = $helper;
        $helperData = collect($helperData)->toArray();

        $userData = $helper->get_user;

        $response = [
                    'code' => 200,
                    'message' => 'Get Data Berhasil',
                    'success' => true,
                    'data' => [
                        'helper' => $helperData,
                        'user' => $userData
                    ]
                    
                ];
            return response()->json($response);
    }
}
