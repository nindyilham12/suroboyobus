<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\ModelBankSampah;
use App\ModelTukarSampah;
use App\ModelPenumpang;
use App\ModelUser;
use App\ModelTopUp;
use Validator;
use App\Http\Controllers\Controller;

class BankSampahController extends Controller
{   
    //halaman maps penumpang
    public function getbanksampah()
    {
        $data = ModelBankSampah::all();
        return response()->json($data);
    }

    //halaman send sticker di tabel tukar sampah
    public function tukarsampah(Request $request)
    {   
        $tukarsampahData = new ModelTukarSampah();
        $tukarsampahData->user_id_penumpang = $request->input('user_id_penumpang'); 
        $tukarsampahData->user_id_banksampah = $request->input('user_id_banksampah'); 
        $tukarsampahData->sticker_tukarsampah = $request->input('sticker_tukarsampah');
        $tukarsampahData->botolbesar_tukarsampah = $request->input('botolbesar_tukarsampah');
        $tukarsampahData->botolmedium_tukarsampah = $request->input('botolmedium_tukarsampah');
        $tukarsampahData->gelasplastik_tukarsampah = $request->input('gelasplastik_tukarsampah');
        $tukarsampahData->sampah_tukarsampah = $request->input('botolbesar_tukarsampah') + $request->input('botolmedium_tukarsampah') + $request->input('gelasplastik_tukarsampah') ;

        //menampilkan jumlah sampah dan sticker banksampah
        $banksampahData = ModelBankSampah::where(['user_id_banksampah' => $request->input('user_id_banksampah')])->first();
               
        //menampilkan sticker penumpang 
        $penumpangData = ModelPenumpang::where(['user_id_penumpang' => $request->input('user_id_penumpang')])->first();

        if($banksampahData->sticker_banksampah >= $tukarsampahData->sticker_tukarsampah){
            $penumpangData->sticker_penumpang = $penumpangData->sticker_penumpang + $request->input('sticker_tukarsampah');
            $banksampahData->sampah_banksampah = $banksampahData->sampah_banksampah + $tukarsampahData->sampah_tukarsampah;

            $banksampahData->botolbesar_banksampah = $banksampahData->botolbesar_banksampah + $request->input('botolbesar_tukarsampah');
            $banksampahData->botolmedium_banksampah = $banksampahData->botolmedium_banksampah + $request->input('botolmedium_tukarsampah');
            $banksampahData->gelasplastik_banksampah = $banksampahData->gelasplastik_banksampah + $request->input('gelasplastik_tukarsampah');

            $banksampahData->sticker_banksampah = $banksampahData->sticker_banksampah - $request->input('sticker_tukarsampah'); 

            $tukarsampahData->save();
            $tukarsampahData->datetime = $tukarsampahData->created_at;
            $penumpangData->save();
            $banksampahData->save();
            $response = [
                'code' => 200,
                'message' => 'Send Sticker Berhasil',
                'success' => true,
                'data' => ['tukarsampah'=> $tukarsampahData, 'penumpang' => $penumpangData, 'banksampah'=> $banksampahData] 
            ];
        }else{
            $response = [
                    'code' => 300,
                    'message' => 'Sticker Bank Sampah Tidak Mencukupi',
                    'success' => false,
                    'data' => null 
                ];            
        }
        return response()->json($response);
    }

    //halaman history send sticker
    public function historytukarsampah(Request $request)
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

        $tukarsampahData['user_id_banksampah']  = $request->request->get('user_id_banksampah');
        $tukarsampahData = ModelTukarSampah::where(['user_id_banksampah' => $userId])
        ->with(['get_penumpang'])
        ->get();

        $response = [
                'code' => 200,
                'message' => 'Get Data Berhasil',
                'success' => true,
                'data' => $tukarsampahData
            ];
            return response()->json($response);
    }

    //data untuk halaman profile dan detail sticker banksampah
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

        $banksampah = ModelBankSampah::where(['user_id_banksampah' => $userId])->first();
        $banksampahData = $banksampah;
        $banksampahData = collect($banksampahData)->toArray();

        $userData = $banksampah->get_user;

        $response = [
                    'code' => 200,
                    'message' => 'Get Data Berhasil',
                    'success' => true,
                    'data' => [
                        'banksampah' => $banksampahData,
                        'user' => $userData
                    ]
                    
                ];
            return response()->json($response);
    }

    //data untuk halaman top up sticker banksampah
    public function topup(Request $request)
    {   
        $topupData = new ModelTopUp();
        $topupData->user_id_banksampah = $request->input('user_id_banksampah'); 
        $topupData->sticker_topup = $request->input('sticker_topup');

        //menampilkan jumlah sticker banksampah setelah topup
        $banksampahData = ModelBankSampah::where(['user_id_banksampah' => $request->input('user_id_banksampah')])->first();
        $banksampahData->sticker_banksampah = $banksampahData->sticker_banksampah + $request->input('sticker_topup');

        $topupData->save();
        $topupData->datetime = $topupData->created_at;
        $banksampahData->save();

        $response = [
                'code' => 200,
                'message' => 'Top Up Berhasil',
                'success' => true,
                'data' => [
                        'topup' => $topupData,
                        'banksampah' => $banksampahData
                    ]
            ];
            return response()->json($response);
    }

    //halaman history top up 
    public function historytopup(Request $request)
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

        $topupData['user_id_banksampah']  = $request->request->get('user_id_banksampah');
        $topupData = ModelTopUp::where(['user_id_banksampah' => $userId])->get();

        $response = [
                'code' => 200,
                'message' => 'Get Data Berhasil',
                'success' => true,
                'data' => $topupData
            ];
            return response()->json($response);
    }
}
