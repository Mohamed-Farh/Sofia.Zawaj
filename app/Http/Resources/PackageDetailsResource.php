<?php

namespace App\Http\Resources;

use App\Models\Member_Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;


class PackageDetailsResource extends JsonResource
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
        $member != '' ? $like = 1 : $like = 0;

        $member = Member_Relation::where('member_id', $loginId)
                                  ->where('ignore_list','1')
                                  ->where('my_id',$this->id)
                                  ->orderBy('id', 'desc')
                                  ->first();
        $member != '' ? $block = 1 : $block = 0;

        $member = Member_Relation::where('member_id', $loginId)
                                ->where('visit_profile','1')
                                ->where('my_id',$this->id)
                                ->orderBy('id', 'desc')
                                ->first();
        $member != '' ? $visit_profile = 1 : $visit_profile = 0;

        return [
            "id" => $this->id,
            "name" => $this->name,
            "image" => $this->image,
            "gender" => $this->gender,
            "country" => $this->country,
            "city" => $this->city,
            "nationality" => $this->nationality,
            "marriage_type" => $this->marriage_type,
            "marital_status" => $this->marital_status,
            "age" => $this->age,
            "children_number" => $this->children_number,
            "children_with" => $this->children_with,
            "hair_color" => $this->hair_color,
            "listen_music" => $this->listen_music,
            "weight" => $this->weight,
            "tall" => $this->tall,
            "skin" => $this->skin,
            "body_status" => $this->body_status,
            "religiosity" => $this->religiosity,
            "pray" => $this->pray,
            "smoke" => $this->smoke,
            "beard" => $this->beard,
            "hair_color" => $this->hair_color,
            "hegab" => $this->hegab,
            "education" => $this->education,
            "education_type" => $this->education_type,
            "money_status" => $this->money_status,
            "work_field" => $this->work_field,
            "work" => $this->work,
            "money_month" => $this->money_month,
            "health_status" => $this->health_status,
            "partner_description" => $this->partner_description,
            "your_description" => $this->your_description,
            "profile_link" => "zaytona.online/show_member_details_page/".$this->id,
            "like" => $like,
            "block" => $block,
            "visit_profile" => $visit_profile,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}


