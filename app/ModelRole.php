<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelRole extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    public $timestamps = false;
     protected $fillable = [
    	'role_id',
    	'level'
    ];


    public function get_user(){
    	return $this->hasMany('App\ModelUser','role_id', 'user_id');
    }
}
