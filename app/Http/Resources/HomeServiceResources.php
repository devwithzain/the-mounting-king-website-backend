<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeServiceResources extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'heading' => $this->heading,
            'description' => $this->description,
            'image' => $this->image,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}