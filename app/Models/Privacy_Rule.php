<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privacy_Rule extends Model
{
    protected $table = 'privacy_rules';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'type',
        'status',
    ];
}
