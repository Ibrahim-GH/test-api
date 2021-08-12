<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProductsResource extends JsonResource
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
            'name' => $this->name,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'products' => ProductResource::collection($this->Products),
        ];
    }
}
