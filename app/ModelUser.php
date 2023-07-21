<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelUser extends Model
{
    protected $table = 'users';
    protected $primariKey = 'user_id';
    protected $fillable = [
        'email',
        'password',
        'role_id'
    ];

    public function get_tukarsampah()
    {
        return $this->hasOne('App\ModelTukarSampah', 'user_id_banksampah', 'id_tukarsampah');
    }

    public function get_topup()
    {
        return $this->hasOne('App\ModelTopUp', 'user_id_banksampah', 'id_topup');
    }

    public function get_role()
    {
        return $this->hasOne('App\ModelRole', 'role_id', 'role_id');
    }

    public function get_penumpang()
    {
        return $this->hasOne('App\ModelPenumpang', 'user_id_penumpang', 'id_penumpang');
    }

    public function get_naikbus()
    {
        return $this->hasOne('App\ModelNaikBus', 'user_id_helper', 'id_naikbus');
    }

    public function get_helper()
    {
        return $this->hasOne('App\ModelHelper', 'user_id_helper', 'id_helper');
    }

    public function get_banksampah()
    {
        return $this->hasOne('App\ModelBankSampah', 'user_id_banksampah', 'id_banksampah');
    }

    public function get_bus()
    {
        return $this->hasOne('App\ModelBankSampah', 'user_id', 'id_bus');
    }

}
