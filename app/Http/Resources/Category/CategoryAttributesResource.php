<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Attribute\AttributeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryAttributesResource extends JsonResource
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
            'name' => $this->name,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'storeId' => $this->store_id,
            'attributes' => AttributeResource::collection($this->Attributes),
        ];
    }
}
