<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 10/11/20
 * Time: 13:53
 */

namespace Chicorycom\Cigaformation\Models;


use Illuminate\Database\Eloquent\Model;

class Preregister extends Model
{



    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
