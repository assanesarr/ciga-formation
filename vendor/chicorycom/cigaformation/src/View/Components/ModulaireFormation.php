<?php

namespace Chicorycom\Cigaformation\View\Components;

use Chicorycom\Cigaformation\Models\Menu;
use Illuminate\View\Component;

class ModulaireFormation extends Component
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
        $menu = Menu::with('formation')
            ->where('slug', 'formation-modulaire')->first();

        return view('chicorycom::components.modulaire-formation',[
            'formations' => $menu->formation
        ]);
    }
}
