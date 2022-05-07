<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package_Feature extends Model
{
    protected $table = 'package_features';

    protected $primaryKey = 'id';

    protected $fillable =[

         'name',
         'package_id',
         'status',
   ];
}
