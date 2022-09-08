<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use DataTables;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('q') && $request->q != '') {
            $queryParams = $request->q;
            $news = News::active()->with('user:id,name')->where('title', 'LIKE', "%$queryParams%")->paginate(5);
        } else {
            $news = News::active()->with('user:id,name')->paginate(5);
        }
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $request->all();
        try {
            $path = base_path('') . '/public/asset/img/news/thumbnail/';
            $name = date('Y-m-d') . '-' . uniqid() . $data['thumbnail']->getClientOriginalName();
            move_uploaded_file($data['thumbnail'], $path . $name);
        } catch (\Throwable $th) {
            return abort(500);
        }
        $data['thumbnail'] = asset('/asset/img/news/thumbnail/' . $name);
        News::create($data);
        return redirect()->back()->withSuccess('Berhasil membuat berita');
    }

    /**
     * Display the specified resource.
     *
     * @param  String $slugWithDate
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $news = News::with('category', 'user:id,name')->where('slug', $slug)->firstOrFail();
        $news->incrementViews();
        $relatedNews = News::where('category_id', $news->category->id)->where('slug', '!=', $news->slug)->limit(3)->orderBy('created_at', 'DESC')->get();
        return view('news.show', compact('news', 'relatedNews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $news = News::with('category')->where('slug', $slug)->firstOrFail();
        $categories = Category::get();
        return view('news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateNewsRequest  $request
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, $slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $data = $request->all();
        if ($request->has('thumbnail')) {
            $path = base_path('') . '/public/asset/img/news/thumbnail/';
            $name = date('Y-m-d') . '-' . uniqid() . $data['thumbnail']->getClientOriginalName();
            try {
                move_uploaded_file($data['thumbnail'], $path . $name);
            } catch (\Throwable $th) {
                dd($th);
                return abort(500);
            }
            $data['thumbnail'] = asset('/asset/img/news/thumbnail/' . $name);
        }

        $news->update($data);
        return redirect()->back()->with('success', 'Berhasil membuat berita');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $news->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus berita');
    }

    /**
     * Display a listing of the resource for user.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexForUser()
    {
        return view('news.index-for-user');
    }

    public function getAllNews(Request $request)
    {
        $news = News::with('category')->select('id', 'category_id', 'title', 'slug', 'views', 'active')->selectRaw('DATE(created_at) as created_at');
        
        return Datatables::eloquent($news)
                            ->addColumn('action', function ($row) {
                                $icon = $row->active == 1? 'fa fa-eye-slash':'fa fa-eye';
                                $delete = '
                                <form method="POST" action="'.route('berita.destroy', ['beritum'=>$row->slug]).'">
                                    '.csrf_field().'
                                    <input type="hidden" name="_method" value="DELETE"/>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>';
                                $actionBtn = '<div class="btn-group" role="group">';
                                $actionBtn .= '<button url="'.route('api.berita.toggleActive', ['beritum'=>$row->id]).'" class="btn btn-primary"><i class="'.$icon.'"></i></button>';
                                $actionBtn .= '<a href="'.route('berita.edit', ['beritum'=>$row->slug]).'" class="btn btn-warning mx-1"><i class="fa fa-edit"></i></a>';
                                $actionBtn .= $delete;
                                $actionBtn .= '</div>';
                                return $actionBtn;
                            })
                            ->addIndexColumn()
                            ->toJson();
    }

    public function toggleActive(News $beritum)
    {
        if ($beritum->toggleActive()) {
            return response()->json([], 204);
        }
        return response()->json([], 500);
    }
}
