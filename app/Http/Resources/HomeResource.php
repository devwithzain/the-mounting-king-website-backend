<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'heading' => $this->heading,
            'subHeading' => $this->subHeading,
            'description' => $this->description,
            'image' => $this->image,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}