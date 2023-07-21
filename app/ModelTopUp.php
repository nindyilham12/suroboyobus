<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelTopUp extends Model
{
    protected $table = 'topup';
    protected $primaryKey = 'id_topup';
    public $timestamps = true;

     public function get_user(){
        return $this->hasOne('App\ModelUser','user_id', 'user_id_banksampah');
    }
}
