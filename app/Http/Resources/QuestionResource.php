<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'title' => $this->title,
            'path' => ("/question/$this->slug"),
            'slug' => ("$this->slug"),
            'replies'=>$this->replies,
            'reply_count'=>$this->replies->count(),
            'user'  => $this->user['name'],
            'userId'  => $this->user['id'],
            'created_at'  => $this->created_at->diffForHumans(),
            'body' => substr($this->body,0,255)
        ];
    }
}
