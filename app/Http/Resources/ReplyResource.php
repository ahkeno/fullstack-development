<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'reply' =>$this->body,
            'user'  =>$this->user->name,
            'liked' => !! $this->like->where('user_id', auth()->id())->count(),
            'like_count' => $this->like->count(),
            'created_at'    =>$this->created_at->diffForHumans()
        ];
    }
}
