<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class Header extends Component
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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $logo = DB::table('abouts')->select('value')->where('key', 'logo')->pluck('value')->first();
        $services = DB::table('services')->select('name')->get();
        return view('components.layout.header', compact('services', 'logo'));
    }
}
