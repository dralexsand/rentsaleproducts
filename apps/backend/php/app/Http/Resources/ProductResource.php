<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'title' => $this->title,
            'price' => $this->price,
            'rental_cost_per_hour' => $this->rental_cost_per_hour,
            //'status_id' => $this->status_id,
            'status' => $this->status,
            'code' => $this->code,
        ];
    }
}
