<?php

namespace Chicorycom\Cigaformation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at', 'updated_at','id'
    ];

    protected $with = [
        'permissions'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
