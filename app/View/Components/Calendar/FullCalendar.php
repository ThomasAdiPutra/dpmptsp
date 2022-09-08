<?php

namespace App\View\Components\Calendar;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class FullCalendar extends Component
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
        $agendas = DB::table('agendas')->whereBetween('start_date', [now()->subYear(1), now()->addYear(1)])->get();
        return view('components.calendar.full-calendar', compact('agendas'));
    }
}
