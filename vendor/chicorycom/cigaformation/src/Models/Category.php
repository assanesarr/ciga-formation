<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 11/11/20
 * Time: 10:15
 */

namespace Chicorycom\Cigaformation\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{


    protected $guarded = [
        'created_at', 'updated_at'
    ];


    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

}
