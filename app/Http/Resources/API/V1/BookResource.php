<?php

namespace App\Http\Resources\API\V1;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * @mixin Book
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'isbn' => $this->isbn,
            'pages' => $this->pages,
            'stock' => $this->stock,
            'published_at' => $this->published_at,
            'author' => new AuthorResource($this->whenLoaded('author')),
            'gender' => new GenderResource($this->whenLoaded('gender')),
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
