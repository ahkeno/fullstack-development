<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pathUI = $this->data['reply']['question']['slug'];
        return [
            'id' => $this->id,
            'repliedBy' => $this->data['repliedBy'],
            'question' => $this->data['question'],
            'path' => ("/question/$pathUI"),
        ];
    }
}