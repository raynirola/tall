<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class BaseLayout extends Component {

    /**
     * Get the view / view contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('layouts.base');
    }
}
