@extends('layout.master-berita', ['title' => $news->title, 'relatedNews' => $relatedNews])

@section('head')
@endsection

@section('main')
    <div class="h2">{{ $news->title }}</div>
    <div class="text-muted">
        <small>
            <span class="float-left">{{ date('d-M-Y', strtotime($news->created_at)) }}</span>
            <span class="float-right"><i class="fa fa-eye pr-2" aria-hidden="true"></i>{{ $news->views }}</span>
        </small>
    </div><br>
    <div class="my-2"><img src="{{ $news->thumbnail }}" alt="{{ $news->title }}" style="max-height:400px" width="100%"></div>
    <div>{!! $news->content !!}</div>
    <div class="category pt-5"><i class="fa fa-tag"></i> #{{ $news->category->category }}</div>
@endsection
