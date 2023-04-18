<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'box_id' => $this->box_id,
            'description' => $this->description,
            'group' => $this->group,
            'location' => $this->box ? $this->box->location : $this->location,
        ];
    }
}
