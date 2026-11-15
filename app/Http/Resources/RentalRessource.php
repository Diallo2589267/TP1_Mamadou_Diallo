<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentalRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'totalPrice' => $this->totalPrice,
            // 'user_id' => $this->user_id,
            // 'equipment_id' => $this->equipment_id,
            'user'=>$this->user?->firstName.' '.$this->user?->lastName,
            'equipment' => $this->equipment?->name,

        ];
    }
}
