<div class="card">
    <div class="card-header p-2">
        <div class="card-title m-0">Berita Terhangat</div>
    </div>
    <div class="card-body py-2 px-2">
        @foreach ($news as $n)
            <x-news.card title="{{ $n->title }}" image="{{ $n->thumbnail }}" date="{{ $n->created_at }}" slug="{{ $n->slug }}"/>
        @endforeach
    </div>
</div>