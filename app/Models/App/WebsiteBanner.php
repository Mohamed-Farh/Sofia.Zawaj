<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;

class WebsiteBanner extends Model
{
    protected $table = 'website_banner';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'text',
        'image',
        'status',

    ];
}
