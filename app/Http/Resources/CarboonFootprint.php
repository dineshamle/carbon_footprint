<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarboonFootprint extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'carbonFootprint' => $this->carbonFootprint,
            'errorMessage' => $this->errorMessage,
        ];
    }
}
