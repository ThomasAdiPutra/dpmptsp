@extends('layout.master', ['title'=>'Standar Operasional Prosedur'])

@section('head')

@endsection

@section('main')
    <div>
        <object data="{{ $sop }}" type="application/pdf" style="width: 100%; height: 85vh;">
            <a href="{{ $sop }}" download>SOP</a>
        </object>
    </div>
@endsection

@section('script')
@endsection
