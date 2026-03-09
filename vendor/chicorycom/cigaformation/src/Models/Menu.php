<?php

namespace Chicorycom\Cigaformation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at', 'updated_at','id'
    ];

    protected $with = [
        'page',
    ];

    const ADMIN = 'ADMIN';
    const PUBLIC = 'PUBLIC';

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->with('formation')
            ->orderBy('order');
    }

    public function formation()
    {
        return $this->hasMany(Formation::class, 'type')
            ->where('status', true)
            ->where('top', true);
    }

    public function page(){
        return $this->belongsToMany(Page::class);
    }


    public function scopeAdmin($query){
        return $query->with('children')->whereNull('parent_id')->where('type', static::ADMIN)->orderBy('order')->get();
    }

    public function scopePublic($query){
        return $query->with('children')->whereNull('parent_id')->where('type', static::PUBLIC)->orderBy('order')->get();
    }
    public function scopeFormations($query){
        return $query->with('children')->where('slug', 'public-formations')->where('type', static::PUBLIC)->orderBy('order')->first();
    }


    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug($value, '-');
    }
}
