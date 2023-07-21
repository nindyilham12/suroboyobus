<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelNaikBus extends Model
{
    protected $table = 'naikbus';
    protected $primaryKey = 'id_naikbus';
    public $timestamps = true;

    public function get_user(){
        return $this->hasOne('App\ModelUser','user_id', 'user_id_helper');
    }

    public function get_penumpang(){
        return $this->hasOne('App\ModelPenumpang', 'user_id_penumpang', 'user_id_penumpang');
    }

    public function get_helper(){
        return $this->hasOne('App\ModelHelper', 'user_id_helper', 'user_id_helper');
    }
}
