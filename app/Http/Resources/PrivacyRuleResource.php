<?php

namespace App\Http\Resources;

use App\Models\Member;
use App\Models\Member_Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;


class PrivacyRuleResource extends JsonResource
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
            "text" => isset($this->name) ? $this->name : '',
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}


