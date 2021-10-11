<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Statement extends JsonResource
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
            'date_balance' => $this->created_at->format('d/m/Y H:i:s'),
            'type' => $this->type,
            'value' => $this->value,
            'previous_balance' => $this->previous_balance,
            'later_balance' => $this->later_balance
        ];
    }
}
