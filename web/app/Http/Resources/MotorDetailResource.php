<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MotorDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [

            'id' => $this->id,
            'nama_motor' => $this->nama_motor,
            'tentang_motor' => $this->tentang_motor,
            'author_id' => $this->author,
            'writer' => $this->whenLoaded('writer'),
            'rating_total' => $this->whenLoaded('comments', function(){
                return count($this->comments);
            }),
            'rating' => $this->whenLoaded('comments', function(){
                return collect($this->comments)->each(function($comment){
                    $comment->commentator;
                    return $comment;
                });
            }),
            // 'created_at' => $this->created_at,
            'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
        ];
    }
}