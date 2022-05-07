<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

use Tymon\JWTAuth\Contracts\JWTSubject;

class Member extends Authenticatable implements JWTSubject
{
    use LaratrustUserTrait;
    use Notifiable;

    protected $guard = 'member';

    protected $table = 'members';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'code_no',
        'email',
        'password',
        'image',
        'admin',
        'gender',

        'country',
        'city',
        'nationality',
        'dual_nationality',

        'marriage_type',
        'marital_status',
        'age',
        'children_number',
        'children_with',

        'weight',
        'tall',
        'skin',
        'hair_color',
        'listen_music',
        'body_status',

        'religiosity',
        'pray',
        'smoke',
        'beard',
        'hegab',

        'education',
        'education_type',
        'money_status',
        'work_field',
        'work',
        'money_month',
        'health_status',

        'partner_description',
        'your_description',

        'full_name',
        'phone',


        'status',
        'online',
        'condition_agree',
        'last_seen',
    ];


        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = bcrypt($value);
    }
}
