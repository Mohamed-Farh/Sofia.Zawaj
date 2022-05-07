<?php

namespace App\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{


    protected $table = 'countries';
    public $timestamps = false;

    protected $fillable = array('name', 'status');


    public function states()
    {
        return $this->hasMany(State::class);
    }
}
