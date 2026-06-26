<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * Controls exactly which fields the API exposes.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'author'      => $this->author,
            'genre'       => $this->genre,
            'description' => $this->description,
            'cover_url'   => $this->cover_image
                                ? asset('storage/' . $this->cover_image)
                                : asset('storage/book_covers/default.jpg'),
            'owner'       => $this->user->username,
            'owner_id'    => $this->user_id,
            'created_at'  => $this->created_at->toDateString(),
        ];
    }
}
