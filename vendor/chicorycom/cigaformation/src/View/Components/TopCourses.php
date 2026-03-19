<?php

namespace Chicorycom\Cigaformation\View\Components;

use Chicorycom\Cigaformation\Models\Formation;
use Chicorycom\Cigaformation\Models\Menu;
use Illuminate\View\Component;

class TopCourses extends Component
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

        return view('chicorycom::components.top-courses', [
            'toFormations' => Formation::toFormation()
        ]);
    }
}
