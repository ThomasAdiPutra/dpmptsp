<?php

namespace App\Http\Controllers;

use App\Models\SKM;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard after successfuly login
     * 
     * @return  \Illumniate\Http\Response
     */
    public function index()
    {
        $query = DB::table(config('visitor.table_name'))->selectRaw('DATE(created_at) as date, COUNT(id) as count')->groupByRAW('DATE(created_at)')->get();
        $visitor['week'] = $query->whereBetween('date', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')]);

        for ($i = 0; $i < 7; $i++) {
            $week[] = now()->startOfWeek()->addDay($i)->format('Y-m-d');
        }
        
        foreach($week as $value){
            if(!in_array($value, $visitor['week']->values()->keyBy('date')->keys()->toArray())){
                $day = (object)['date'=>$value, 'count'=>0];
                $visitor['week'] = $visitor['week']->add($day);
            }
        }
        $visitor['week'] = $visitor['week']->sortBy('date');
        $visitor['all'] = $query->sum('count');
        $complaint = DB::table('complaints')->count();
        $service = DB::table('services')->count();
        $news = DB::table('news')->count();
        $skm = SKM::with('result', 'result.indicator')->orderBy('created_at', 'DESC')->first();
        return view('dashboard', compact('visitor', 'complaint', 'news', 'skm'));
    }
}
