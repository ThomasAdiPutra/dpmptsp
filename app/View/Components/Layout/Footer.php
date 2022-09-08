<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class Footer extends Component
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
        $query = DB::table(config('visitor.table_name'))->selectRaw('DATE(created_at) as date, COUNT(id) as count')->groupByRAW('DATE(created_at)')->get();
        $visitor['today'] = $query->where('date', now()->format('Y-m-d'))->sum('count');
        $visitor['week'] = $query->whereBetween('date', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')])->sum('count');
        $visitor['month'] = $query->whereBetween('date', [now()->startOfMonth()->format('Y-m-d'), now()->endOfMonth()->format('Y-m-d')])->sum('count');
        
        $related_links = DB::table('related_links')->orderBy('order')->get();
        $contacts = DB::table('contacts')->select(['key', 'value'])->get()->keyBy('key');
        return view('components.layout.footer', compact('related_links', 'contacts'));
    }
}
