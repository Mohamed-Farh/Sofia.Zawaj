<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthMemberResource extends JsonResource
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
            "id" => isset($this->id) ? $this->id : '',
            "name" => isset($this->name) ? $this->name : '',
            "full_name" => isset($this->full_name) ? $this->full_name : '',
            "email" => isset($this->email) ? $this->email : '',
            "phone" => isset($this->phone) ? $this->phone : '',
            "image" => isset($this->image) ? $this->image : '',
            "gender" => isset($this->gender) ? $this->gender : '',
            "country" => isset($this->country) ? $this->country : '',
            "city" => isset($this->city) ? $this->city : '',
            "nationality" => isset($this->nationality) ? $this->nationality : '',
            "marriage_type" => isset($this->marriage_type) ? $this->marriage_type : '',
            "marital_status" => isset($this->marital_status) ? $this->marital_status : '',
            "age" => isset($this->age) ? $this->age : '',
            "children_number" => isset($this->children_number) ? $this->children_number : '',
            "children_with" => isset($this->children_with) ? $this->children_with : '',
            "hair_color" => isset($this->hair_color) ? $this->hair_color : '',
            "listen_music" => isset($this->listen_music) ? $this->listen_music : '',
            "weight" => isset($this->weight) ? $this->weight : '',
            "tall" => isset($this->tall) ? $this->tall : '',
            "skin" => isset($this->skin) ? $this->skin : '',
            "body_status" => isset($this->body_status) ? $this->body_status : '',
            "religiosity" => isset($this->religiosity) ? $this->religiosity : '',
            "pray" => isset($this->pray) ? $this->pray : '',
            "smoke" => isset($this->smoke) ? $this->smoke : '',
            "beard" => isset($this->beard) ? $this->beard : '',
            "hair_color" => isset($this->hair_color) ? $this->hair_color : '',
            "hegab" => isset($this->hegab) ? $this->hegab : '',
            "education" => isset($this->education) ? $this->education : '',
            "education_type" => isset($this->education_type) ? $this->education_type : '',
            "money_status" => isset($this->money_status) ? $this->money_status : '',
            "work_field" => isset($this->work_field) ? $this->work_field : '',
            "work" => isset($this->work) ? $this->work : '',
            "money_month" => isset($this->money_month) ? $this->money_month : '',
            "health_status" => isset($this->health_status) ? $this->health_status : '',
            "partner_description" => isset($this->partner_description) ? $this->partner_description : '',
            "your_description" => isset($this->your_description) ? $this->your_description : '',
            "profile_link" => "zaytona.online/show_member_details_page/".$this->id,
            "premium" => 0,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}


