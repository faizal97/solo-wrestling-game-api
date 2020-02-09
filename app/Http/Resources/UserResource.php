<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_id' => $this->user_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'ring_name' => $this->ring_name,
            'title' => $this->title,
            'role' => $this->role,
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',
            'message' => __("User's Data"),
        ];
    }
}
