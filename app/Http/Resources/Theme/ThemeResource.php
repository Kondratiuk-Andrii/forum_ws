<?php

namespace App\Http\Resources\Theme;

use Illuminate\Http\Request;
use App\Http\Resources\Branch\BranchResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ThemeResource extends JsonResource
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
            'description' => $this->description,
            'branch_id' => $this->branch_id,
            'branch' => BranchResource::make($this->branch),
        ];
    }
}
