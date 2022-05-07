<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App_Feature extends Model
{
    protected $table = 'app_features';

    protected $primaryKey = 'id';

    protected $fillable =[

         'feature_type',
         'feature_text',
         'status',

   ];
}
