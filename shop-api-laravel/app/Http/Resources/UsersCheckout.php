<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersCheckout extends JsonResource
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
            'id'           => $this->id,
            'name'         => $this->name,
            'surname'      => $this->surname,
            'email'        => $this->email,
            'adress'       => $this->adress,
            'city'         => $this->city,
            'country'      => $this->country,
            'mobile_phone' => $this->mobile_phone
        ];
    }
}
