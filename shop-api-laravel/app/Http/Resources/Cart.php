<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cart extends JsonResource
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
            'id_cart'      => $this->id_cart,
            'article_id'   => $this->article_id,
            'quantity'     => $this->quantity,
            'image'        => $this->image,
            'price'        => $this->price
        ];
    }
}
