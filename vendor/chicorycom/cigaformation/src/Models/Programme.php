<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 10/11/20
 * Time: 16:14
 */

namespace Chicorycom\Cigaformation\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];
}
