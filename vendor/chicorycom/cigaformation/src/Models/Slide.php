<?php

namespace Chicorycom\Cigaformation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function scopeCarousel($query){
        return $query->where('status', true)->orderBy('id', 'desc')->get();

    }

    public function scopeCarouselall($query){
        return $query->orderBy('id', 'desc')->get();

    }

}
