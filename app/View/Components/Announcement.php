<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Announcement extends Component
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
        $announcements = DB::table('announcements')
                            ->where('start_date', '<=', now())
                            ->where('end_date', '>=', now())
                            ->get();
        return view('components.announcement', compact('announcements'));
    }
}
