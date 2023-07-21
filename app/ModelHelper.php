<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelHelper extends Model
{
   protected $table = 'helper';
   protected $primaryKey = 'id_helper';

    public function get_user()
    {
        return $this->hasOne('App\ModelUser', 'user_id', 'user_id_helper');
    }

    public function get_naikbus(){
    	return $this->hasOne('App\ModelNaikBus', 'user_id', 'sticker_naikbus');
    }
}
