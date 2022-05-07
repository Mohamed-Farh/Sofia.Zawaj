<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'month_no',
        'price',
        'description',
        'pay_join',
        'after_choose_pay',
        'status',
        'pay_method',

    ];
}
