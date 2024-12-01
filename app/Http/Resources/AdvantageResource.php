<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvantageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subTitle' => $this->subTitle,
            'serviceTitle1' => $this->serviceTitle1,
            'serviceTitle2' => $this->serviceTitle2,
            'serviceTitle3' => $this->serviceTitle3,
            'serviceDescription1' => $this->serviceDescription1,
            'serviceDescription2' => $this->serviceDescription2,
            'serviceDescription3' => $this->serviceDescription3,
            'serviceImage1' => $this->serviceImage1,
            'serviceImage2' => $this->serviceImage2,
            'serviceImage3' => $this->serviceImage3,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}