<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
           
            'Content' => $this->message_prompt,
                'user' => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                ],
                'user' => new UserResource($this->user),
                'created_at' => $this->created_at,
        ];
    }
}
