<?php
declare(strict_types = 1);

namespace App\View\Components\Layout;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

final class Menu extends Component
{
    public Collection $menu;

    public function __construct()
    {
        $this->menu = collect(config('menu'));
    }

    public function render()
    {
        return view('components.layout.menu');
    }
}
