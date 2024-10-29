<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepositsViewResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->resource->appends($request->validated());
        return [
            'data' => $this->resource->toArray($request),
            'pagination' => $this->resource->appends($request->validated()),
            'filters' => $request->validated()
        ];
    }
}
