<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $className = explode("\\", $this->commentable_type);
        $className = __NAMESPACE__ ."\\". end($className);
        $commentableResource = new $className($this->commentable);
        unset($className);

        $imageUrl = $this->media[0]->getFullUrl() ?? "";

        return [
            'id' => $this->id,
            'user' => new User($this->user),
            'to' => $commentableResource,
            'rating' => $this->rating,
            'text' => $this->text,
            'image' => $imageUrl
        ];
    }
}
