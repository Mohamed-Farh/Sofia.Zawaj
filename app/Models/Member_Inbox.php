<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member_Inbox extends Model
{
    protected $table = 'member_inboxs';

    protected $primaryKey = 'id';

    protected $fillable =[

         'subject',
         'message',
         'member_id',
         'sender_member_id',
         'show',
         'status',
         'read',
   ];
}
