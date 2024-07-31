<?php

namespace App\Http\Resources\API\V1;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * @mixin Author
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
