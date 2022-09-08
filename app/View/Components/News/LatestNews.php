<?php

namespace App\View\Components\News;

use App\Models\News;
use Illuminate\View\Component;

class LatestNews extends Component
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
        $news = News::select(['title', 'thumbnail', 'slug', 'created_at'])->active()->latest()->limit(3)->get();
        return view('components.news.latest-news', compact('news'));
    }
}
