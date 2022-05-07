<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $table = 'states';
    public $timestamps = false;
    protected $fillable = array('id', 'name', 'status', "country_id");

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
