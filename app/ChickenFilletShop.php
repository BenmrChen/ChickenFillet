<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChickenFilletShop extends Model
{
    /**
     * 可以被批量賦值的屬性。
     *
     * @var array
     */
    protected $fillable = [
        'type_id',
        'name',
        'operation_time',
        'area',
        'chain_store',
        'feature',
        'phone_order',
    ];

    /**
     * 取得雞排的分類
     */
    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
