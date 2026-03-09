<?php

namespace App\View\Components;

use Chicorycom\Cigaformation\Models\Event;
use Illuminate\View\Component;

class AboutEvent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.about-event');
    }
}
