<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChickenFilletShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => new TypeResource($this->type),
            'name' => $this->name,
            'operation_time' => $this->operation_time,
            'area' => $this->area,
            'chain_store' => $this->chain_store,
            'feature' => $this->feature,
            'phone_order' => $this->phone_order,
            'created_at' => $this->created_at != null ? $this->created_at->toDateTimeString() : null,
            'updated_at' => $this->updated_at != null ? $this->updated_at->toDateTimeString() : null,
            'lasting_period'    => $this->lastingperiod, // 這個會對應到app/ChickenFilletShop裡的getLastingperiodAttribute方法
        ];
    }
}
