<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Comment\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'body'           => $this->body,
            'published'      => $this->published,
            'published_at'   => $this->published_at?->toIso8601String(),
            'comments_count' => $this->whenCounted('comments'),
            'author'         => [
                'id'   => $this->user->id,
                'name' => $this->user->name,
            ],
            'comments' => CommentResource::collection(
                $this->whenLoaded('comments')
            ),
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
