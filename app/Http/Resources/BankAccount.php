<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BankAccount extends JsonResource
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
            'number' => $this->number,
            'agency' => $this->agency,
            'active' => $this->active,
            'customer' => [
                'id' => $this->id,
                'name' => $this->customer_name,
            ],
            'bank' => [
                'name' => $this->bank_name,
            ],
        ];
    }
}
