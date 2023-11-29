<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $req = $request;

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
                'price' => $this->product->price,
                'status' => $this->product->status->status,
                'code' => $this->product->code,
            ],
            'sales_date' => $this->sales_date,
        ];
    }
}
