<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelBus extends Model
{
   protected $table = 'bus';
   protected $primaryKey = 'id_bus';

    public function get_user()
    {
        return $this->hasOne('App\ModelUser', 'user_id', 'user_id');
    }
}
