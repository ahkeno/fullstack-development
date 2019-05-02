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
            'user'  =>$this->user->id,
            'created_at'    =>$this->created_at->diffForHumans()
        ];
    }
}
