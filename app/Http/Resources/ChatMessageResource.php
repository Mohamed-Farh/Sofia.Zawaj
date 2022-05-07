<?php

namespace App\Http\Resources;

use App\Models\Member;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ChatMessageResource extends JsonResource
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
            "id" => $this->id,
            "chat_id" => $this->chat_id,
            "message" => isset($this->message) ? $this->message : '',
            "file" => isset($this->file) ? $this->file : '',
            "direction" => $this->my_id == Auth::guard('member_api')->id() ? 'right' : 'left',
            "seen" => $this->seen,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}


