<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            //this is time for softDeleted()
            'deletedAt' => $this->deleted_at,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'categoryId' => $this->category_id,
            'storeId' => $this->store_id,
        ];
    }
}
