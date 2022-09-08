<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Carousel;
use App\Models\Complaint;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\News;
use App\Models\RelatedLink;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('start_date', '<=', now())
                                    ->where('end_date', '>=', now())
                                    ->get();
        $carousels = Carousel::get();
        $abouts = About::select(['key', 'value'])->whereIn('key', ['visi', 'maklumat_pelayanan', 'tugas_pokok'])->get()->keyBy('key');
        $services = Service::get();
        $agendas = Agenda::select('start_date')
                            ->selectRaw('DATE_SUB(end_date, INTERVAL 1 DAY) as end_date')
                            ->selectRaw('GROUP_CONCAT(title SEPARATOR "~") as title')
                            ->groupBy(['start_date', 'end_date'])
                            ->orderByRaw('ABS(DATEDIFF(start_date, NOW()))')
                            ->limit(5)->get();
        $agendas = $agendas->sortBy(function($agenda){
            return $agenda->start_date;
        });

        $latestNews = News::active()->latest()->limit(5)->get();
        $statistic = [
            'visit' => DB::table(config('visitor.table_name'))->count(),
            'services' => $services->count(),
            'complaint' => Complaint::active()->count()
        ];
        $galleries = Gallery::limit(4)->get();
        $team = User::get();
        $relatedLinks = RelatedLink::get();
        visitor()->visit();
        $whatsapp = Contact::where('key', 'whatsapp')->first()->value;
        return view('index', compact('announcements', 'carousels', 'abouts', 'services', 'agendas', 'latestNews', 'team', 'statistic', 'galleries', 'relatedLinks', 'whatsapp'));
    }
}
