<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company_Location extends Model
{
    protected $table = 'company_location';

    protected $primaryKey = 'id';

    protected $fillable =[

         'country',
         'city',
         'address',
         'phone',
         'whats',
         'map_url',
         'map_frame',
         'status',
   ];
}
