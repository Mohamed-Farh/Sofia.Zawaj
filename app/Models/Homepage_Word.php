<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homepage_Word extends Model
{
    protected $table = 'homepage_words';

    protected $primaryKey = 'id';

    protected $fillable =[

         'description',
         'type',
         'vision',
   ];
}
