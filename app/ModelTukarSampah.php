<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelTukarSampah extends Model
{
    protected $table = 'tukarsampah';
    protected $primaryKey = 'id_tukarsampah';
    public $timestamps = true;

    public function get_user(){
    	return $this->hasOne('App\ModelUser','user_id', 'user_id_banksampah');
    }

    public function get_penumpang(){
    	return $this->hasOne('App\ModelPenumpang', 'user_id_penumpang', 'user_id_penumpang');
    }

    public function get_banksampah(){
    	return $this->hasOne('App\ModelBankSampah', 'user_id_banksampah', 'user_id_banksampah');
    }
}