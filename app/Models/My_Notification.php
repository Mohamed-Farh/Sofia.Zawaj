<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class My_Notification extends Model
{
    protected $table = 'my_notifications';

    protected $primaryKey = 'id';

    protected $fillable = [
        'my_id',
        'member_id',
        'notifications',
        'read',

    ];
}
