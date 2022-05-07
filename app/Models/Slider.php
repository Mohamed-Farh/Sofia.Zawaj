<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $table = 'gallaries';

    protected $primaryKey = 'id';

    protected $fillable =[

         'name',
         'type',
         'path',
         'status',
   ];
}
