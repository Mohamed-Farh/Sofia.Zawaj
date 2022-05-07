<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contactus_messages';

    protected $primaryKey = 'id';

    protected $fillable =[

        'name',
        'phone',
        'email',
        'country',
        'subject',
        'message',
        'status',
   ];
}
