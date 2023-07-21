<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelBankSampah extends Model
{
    protected $table = 'banksampah';
    protected $primaryKey = 'id_banksampah';
    public $timestamps = false;

    public function get_user(){
    	return $this->hasOne('App\ModelUser','user_id', 'user_id_banksampah');
    }
}
