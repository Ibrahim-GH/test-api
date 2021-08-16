<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'item_count' => $this->itemCount,
            'order_number' => $this->orderNumber,
            'status' => $this->status,
            'note' => $this->note,
            //this is time for softDeleted()
            'deletedAt' => $this->deleted_at,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'userId' => $this->user_id,
        ];
    }
}
