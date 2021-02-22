<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Users extends JsonResource
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
            'id'               => $this->id,
            'user_name'        => $this->user_name,
            'name'             => $this->name,
            'surname'          => $this->surname,
            'email'            => $this->email,
            'password'         => $this->password,
            'confirm_password' => $this->confirm_password,
            'active'          => $this->active,
        ];
    }
}
