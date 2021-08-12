<?php

namespace App\Http\Resources\Parameter;

use Illuminate\Http\Resources\Json\JsonResource;

class ParameterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            "name" => $this->name,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            "attribute_id" => $this->attribute_id,
        ];
    }
}
