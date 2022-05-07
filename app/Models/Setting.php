<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $primaryKey = 'id';

    protected $fillable = [
        'member_id',
        'who_can_text_me',
        'nationality_can_text_me',
        'age_can_text_me',
        'show_who_care_me',
        'show_visit_me',
        'show_block_me',
        'show_unblock_me',
        'show_new_messages',
        'show_success_stories',
        'email_send',

    ];
}
