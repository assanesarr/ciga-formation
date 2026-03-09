<?php

namespace Chicorycom\Cigaformation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    protected $with = [
        'menu'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
