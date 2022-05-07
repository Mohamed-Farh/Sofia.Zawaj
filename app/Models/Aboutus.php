<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{
    protected $table = 'aboutus';

    protected $primaryKey = 'id';

    protected $fillable = [
        'aboutus',
        'why_us',
        'smart',
        'secret',
        'safe',
    ];
}
