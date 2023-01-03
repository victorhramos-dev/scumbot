<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommandsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Illuminate\Http\Request  $request
     * 
     * @return  array
     */
    public function toArray($request)
    {
        return CommandResource::collection($this->collection);
    }
}
