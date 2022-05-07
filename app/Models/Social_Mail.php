<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social_Mail extends Model
{
    protected $table = 'social_mails';

    protected $primaryKey = 'id';

    protected $fillable =[

         'name',
         'type',
         'status',
         'link',
   ];
}
