<?php

namespace App\Http\Resources\Store;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'phone number' => $this->phone_number,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            //'userId'=>$this->user_id,
        ];
    }
}
