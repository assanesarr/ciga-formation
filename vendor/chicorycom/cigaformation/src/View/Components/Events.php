<?php

namespace Chicorycom\Cigaformation\View\Components;

use Chicorycom\Cigaformation\Models\Event;
use Illuminate\View\Component;

class Events extends Component
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
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $events =  Event::events();
        return view('chicorycom::components.events', [
            'events' => $events
        ]);
    }
}
