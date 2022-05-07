<?php

namespace App\Http\Resources;

use App\Models\Member;
use App\Models\Member_Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;


class InboxResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $sender = Member::where('id', $this->sender_member_id)->first();
        $data = [
            "id" => $sender->id,
            "name" => $sender->name,
            "no" => $sender->age,
            "image" => $sender->image,
        ];

        return [
            "message_id" => $this->id,
            "subject" => $this->subject,
            "message" => $this->message,
            "read" => $this->read,
            "like" => $this->like,
            "sender_member" => $data,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}


