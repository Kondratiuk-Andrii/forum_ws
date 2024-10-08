<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'title' => $this->title,
            'section_id' => $this->section_id,
            'section_title' => $this->section_title,
            'parent_id' => $this->parent_id,
            'parent_title' => $this->parent_title,
        ];
    }
}
