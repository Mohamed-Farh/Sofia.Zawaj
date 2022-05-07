<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class ChatMember extends Model
{
    protected $table = 'chat_members';

    protected $primaryKey = 'id';

    protected $fillable = [
        'my_id',
        'member_id',
        'my_delete_status',
        'member_delete_status',
        'status',

    ];
}
