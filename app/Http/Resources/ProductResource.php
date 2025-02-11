<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'color' => $this->color,
            'size' => $this->size,
            'category' => $this->category,
            'shortDescription' => $this->shortDescription,
            'price' => $this->price,
            'image' => $this->image,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}