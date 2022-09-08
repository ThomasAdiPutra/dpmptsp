@extends('layout.master', ['title'=>'Visi Misi DPMPTSP'])

@section('head')

@endsection

@section('main')
    <div id="visi-misi" class="py-3">
        <div id="visi">
            <h2><strong>Visi</strong></h2>
            <blockquote class="blockquote">
                <sup><small><i class="fa fa-quote-left" aria-hidden="true"></i></small></sup>
                <span class="text-center px-2">{!! $visi !!}</span>
                <sub><small><i class="fa fa-quote-right"aria-hidden="true"></i></small></sub>
            </blockquote>
        </div>
        <div id="misi" class="pt-5">
            <h2><strong>Misi</strong></h2>
            {!! $misi !!}
        </div>
    </div>
@endsection

@section('script')
@endsection
