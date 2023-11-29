<?php

namespace App\Http\Resources;

use App\Models\ProductRented;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentUserResource extends JsonResource
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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
            'product' => [
                'id' => $this->product->id,
                'title' => $this->product->title,
                'rental_cost_per_hour' => $this->product->rental_cost_per_hour,
                'code' => $this->product->code,
            ],
            'rented_start' => $this->rented_start,
            'rented_end' => (new ProductRented)->getRentedEndDate($this->rented_start, $this->period_id),
            'cosct' => (new ProductRented())->getRentedCostByRentalPeriodId($this->product->id, $this->period_id),
            //'period_id' => $this->period_id,
        ];
    }
}
