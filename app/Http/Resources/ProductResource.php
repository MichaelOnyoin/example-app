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
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'price' => $this->price,
            'originalPrice' => $this->original_price,
            'discount' => $this->discount,
            'title' => $this->title,
            'description' => $this->description,
            'imageUrl' => $this->image_url,
            'brand' => $this->brand,
            'category' => $this->category,
            'type' => $this->type,
            'deals' => $this->deals,
            // 'liked' => $this->liked, // Uncomment if you want to include liked status
            // 'created_at' => $this->created_at->format('d/m/Y'),
            // 'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
