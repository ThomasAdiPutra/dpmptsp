@props(['title', 'image', 'date', 'slug'])
<div class="my-2 clearfix">
    <img src="{{ $image }}" width="60px" height="60px" class="float-left mr-2"/>
    <div class="text-primary mb-2" style="line-height: 90%;"><a
            href="{{ route('berita.show', ['beritum' => $slug]) }}">{{ Str::words($title,3) }}</a></div>
    <small class="text-muted" style="font-size: 12px;">{{ date('Y-m-d', strtotime($date)) }}</small>
</div>
