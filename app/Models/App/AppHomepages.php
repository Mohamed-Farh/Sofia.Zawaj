<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;

class AppHomepages extends Model
{
    protected $table = 'app_homepages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'page_no',
        'title',
        'content',
        'image',
        'status',

    ];
}
