<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Teacher extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $thumbnailUrl = $this->media[0]->getFullUrl() ?? "";

        return [
            'id' => $this->id,
            'position' => $this->position,
            'name' => $this->name,
            'email' => $this->email,
            'biography' => $this->biography,
            'certified' => $this->certified,
            'thumbnail' => $thumbnailUrl
        ];
    }
}
