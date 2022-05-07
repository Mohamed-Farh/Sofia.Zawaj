<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member_Relation extends Model
{
    protected $table = 'member_relations';

    protected $primaryKey = 'id';

    protected $fillable =[

         'my_id',
         'member_id',
         'status',
         'visit_profile',
         'care_list',
         'send_message',
         'success_relation',
   ];
}
