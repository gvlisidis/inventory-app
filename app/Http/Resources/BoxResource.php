<?php

namespace App\Http\Resources;

use App\Enums\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoxResource extends JsonResource
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
            'uri' => $this->uri,
            'location' => $this->location,
            'description' => $this->description,
            'items' => ItemResource::collection($this->items),
        ];
    }
}
