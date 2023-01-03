<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Catalog\ServiceItem;

class CommandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'payload' => $this->payload,
        ];
    }
}
