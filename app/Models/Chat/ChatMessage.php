<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_messages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'my_id',
        'chat_id',
        'message',
        'my_delete_status',
        'member_delete_status',
        'my_chat_delete',
        'member_chat_delete',
        'seen',
    ];
}
