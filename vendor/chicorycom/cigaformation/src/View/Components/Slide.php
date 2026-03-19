<?php

namespace Chicorycom\Cigaformation\View\Components;

use Chicorycom\Cigaformation\Models\Menu;
use Illuminate\View\Component;

class Slide extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $slides =  \Chicorycom\Cigaformation\Models\Slide::carousel();
        return view('chicorycom::components.slide', compact('slides'));
    }
}
