<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country_Member_Setting extends Model
{
    protected $table = 'country_member_settings';

    protected $primaryKey = 'id';

    protected $fillable =[

        'member_id',
        'country_name',
        'type',
        'status',
    ];
}
