<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Member_Relation;
use Illuminate\Support\Facades\Auth;

class GetMembersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $loginId = Auth::guard('member_api')->id();
        $member = Member_Relation::where('member_id', $loginId)
                                  ->where('care_list','1')
                                  ->where('my_id',$this->id)
                                  ->orderBy('id', 'desc')
                                  ->first();
        $member != '' ? $like = "1" : $like = "0";

        $member = Member_Relation::where('member_id', $loginId)
                                  ->where('ignore_list','1')
                                  ->where('my_id',$this->id)
                                  ->orderBy('id', 'desc')
                                  ->first();
        $member != '' ? $block = "1" : $block = "0";

        $member = Member_Relation::where('member_id', $loginId)
                                ->where('visit_profile','1')
                                ->where('my_id',$this->id)
                                ->orderBy('id', 'desc')
                                ->first();
        $member != '' ? $visit_profile = "1" : $visit_profile = "0";

        return [
            "id" => isset($this->id) ? $this->id : '',
            "name" => isset($this->name) ? $this->name : '',
            "image" => isset($this->image) ? $this->image : '',
            "gender" => isset($this->gender) ? $this->gender : '',
            "country" => isset($this->country) ? $this->country : '',
            "city" => isset($this->city) ? $this->city : '',
            "nationality" => isset($this->nationality) ? $this->nationality : '',
            "age" => isset($this->age) ? $this->age : '',
            "like" => $like,
            "block" => $block,
            "premium" => "0",
            "visit_profile" => $visit_profile,
            "last_seen" => isset($this->last_seen) ? $this->last_seen : '',
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}


