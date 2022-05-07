<?php

namespace App\Http\Resources;

use App\Models\Member;
use App\Models\Member_Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;


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

        $member = Member::where('id', $this->member_id)->first();
        if($this->type == 'visit_profile'){
            $icon = 'app-assets/images/1-profile.png';
        }elseif($this->type == 'like_profile'){
            $icon = 'app-assets/images/1-like.png';
        }elseif($this->type == 'unlike_profile'){
            $icon = 'app-assets/images/1-unlike.png';
        }elseif($this->type == 'block_profile'){
            $icon = 'app-assets/images/1-block.png';
        }elseif($this->type == 'unblock_profile'){
            $icon = 'app-assets/images/1-unblock.png';
        }elseif($this->type == 'send_message'){
            $icon = 'app-assets/images/1-message.png';
        }else{
            $icon = 'app-assets/images/1-Notification';
        }

        return [
            "id" => $this->id,
            "icon" => $icon,
            "notification" => isset($this->notifications) ? $this->notifications : '',
            "member_id" => isset($member->id) ? $member->id : '',
            "name" => isset($member->name) ? $member->name : '',
            "image" => isset($member->image) ? $member->image : '',
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}


