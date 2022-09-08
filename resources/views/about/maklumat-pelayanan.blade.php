@extends('layout.master', ['title'=>'Maklumat Pelayanan'])

@section('head')

@endsection

@section('main')
    <div>
        <blockquote class="blockquote">
            <i class="fa fa-quote-left" aria-hidden="true"></i>
            <p class="text-center px-4">{!! $maklumatPelayanan !!}</p>
            <span class="d-flex flex-grow-1 justify-content-end"><i class="fa fa-quote-right"aria-hidden="true"></i></span>
        </blockquote>
    </div>
@endsection

@section('script')
@endsection
