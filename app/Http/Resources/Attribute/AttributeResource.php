<?php

namespace App\Http\Resources\Attribute;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
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
            'category_id'=>$this->category_id
        ];
    }
}
