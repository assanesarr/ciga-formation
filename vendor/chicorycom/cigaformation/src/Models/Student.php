<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 10/11/20
 * Time: 13:53
 */

namespace Chicorycom\Cigaformation\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{

    use HasFactory, Notifiable;


    protected $guard = 'student';

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $appends = ['name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function preregister()
    {
        return $this->hasMany(Preregister::class);
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' .$this->last_name;
    }
}
