<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderHistory extends JsonResource
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
            'email'      => $this->email,
            'article_id'   => $this->article_id ,
            'title'       => $this->title,
            'image'       =>  $this->image,
            'price'       => (int) $this->price,
            'name'         => $this->name,
            'surname'      => $this->surname,
            'adress'       => $this->adress,
            'city'         => $this->city,
            'country'      => $this->country,
            'mobile_phone' => $this->mobile_phone

        ];
    }
}
