<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Success_Relation extends Model
{
    protected $table = 'success_relations';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'age',
        'gender',
        'word',
        'image',
        'status',

    ];
}
