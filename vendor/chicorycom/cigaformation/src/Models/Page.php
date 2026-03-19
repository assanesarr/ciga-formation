<?php

namespace Chicorycom\Cigaformation\Models;

use Chicorycom\Cigaformation\Traits\Resizable;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements Viewable
{
    use  Resizable, InteractsWithViews;

    public $timestamps = false;

    protected $guarded = [];



    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }
}
