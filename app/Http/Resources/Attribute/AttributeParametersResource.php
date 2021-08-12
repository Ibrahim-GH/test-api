<?php

namespace App\Http\Resources\Attribute;

use App\Http\Resources\Parameter\ParameterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeParametersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            "name" => $this->name,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'categoryId' => $this->category_id,
            'parameters' => ParameterResource::collection($this->Parameters),
        ];
    }
}
