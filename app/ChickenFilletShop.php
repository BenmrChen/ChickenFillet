<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'user_id',
    ];

    /**
     * 取得雞排的分類
     */
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    /**
     * 計算店家已新增了多久
     *
     * @param string $value
     * @return string
     */
    public function getLastingperiodAttribute() {
        $diff = Carbon::now()->diff($this->created_at);
        return "{$diff->y}年{$diff->m}月";
    }

}
