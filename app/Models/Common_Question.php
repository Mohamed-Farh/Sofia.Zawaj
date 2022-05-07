<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Common_Question extends Model
{
    protected $table = 'common_questions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'type',
        'question',
        'answer',
        'status',
    ];
}
