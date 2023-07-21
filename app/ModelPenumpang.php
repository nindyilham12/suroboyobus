<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelPenumpang extends Model
{
    protected $table = 'penumpang';
    protected $primaryKey = 'id_penumpang';
    public $timestamps = false;

    public function get_user(){
    	return $this->hasOne('App\ModelUser','user_id', 'user_id_penumpang');
    }

    public function get_tukarsampah(){
    	return $this->hasOne('App\ModelTukarSampah', 'user_id', 'sticker_tukarsampah');
    }
}
