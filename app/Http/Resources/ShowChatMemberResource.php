<?php

namespace App\Http\Resources;

use App\Models\Chat\ChatMessage;
use App\Models\Member;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ShowChatMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        if($this->my_id != Auth::guard('member_api')->id()){
            $id = $this->my_id;
        }else{
            $id = $this->member_id;
        }

        $member = Member::where('id', $id)->first();
        $not_seen = ChatMessage::where('chat_id', $this->id)->where('my_id', $member->id)->where('seen', 0)->count();
        $last = ChatMessage::where('chat_id', $this->id)->orderBy('created_at', 'desc')->first();

        return [
            "chat_id" => $this->id,
            "member_id" => isset($member->id) ? $member->id : '',
            "name" => isset($member->name) ? $member->name : '',
            "image" => isset($member->image) ? $member->image : '',
            "not_seen" => isset($not_seen) ? $not_seen : '',
            "message" => isset($last->message) ? $last->message : '',
            "active" => "0",
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}


