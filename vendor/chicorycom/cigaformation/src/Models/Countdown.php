<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 29/10/20
 * Time: 12:00
 */

namespace Chicorycom\Cigaformation\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countdown extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = true;
    const STATUS_INACTIVE = false;

    public $timestamps = false;

    protected $guarded = [];

    public function scopeCount($query){
        return $query->where('id', 1)->first();
    }

}
