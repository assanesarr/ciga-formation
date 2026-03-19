<?php

namespace Chicorycom\Cigaformation\Models;


use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model implements Viewable
{
    use HasFactory, InteractsWithViews;

    const STATUS_ACTIVE = true;
    const STATUS_INACTIVE = false;

    protected $guarded = [
        'created_at', 'updated_at','id'
    ];


    public function scopeEvents($query){
        return $query->where('status', static::STATUS_ACTIVE)->orderBy('id', 'desc')->get();
    }


}
