<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepositResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'deposit_id' => $this->id,
            'deposit_date_time' => $this->created_at->format('d.m. Y H'),
            'amount' => $this->formatted_amount,
            'player_id' => $this->player_id,
            'name' => $this->player->name,
            'email' => $this->player->email,
            'phone' => $this->player->phone
        ];
    }
}
