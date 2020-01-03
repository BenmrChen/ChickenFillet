<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name',
        'sort'
    ];

    /**
     * 取得類別的雞排店
     */
    public function chickenFillets()
    {
        return $this->hasMany('App\ChickenFilletShop', 'type_id', 'id');
    }
}
