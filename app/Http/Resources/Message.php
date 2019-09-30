<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Message extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $className = explode("\\", $this->messageable_type);
        $className = __NAMESPACE__ ."\\". end($className);
        $messageableResource = new $className($this->messageable);
        unset($className);

        return [
            'id' => $this->id,
            'user' => new User($this->user),
            'to' => $messageableResource,
            'text' => $this->text
        ];
    }
}
