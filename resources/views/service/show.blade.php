@extends('layout.master', ['title'=>'Layanan'])

@section('head')
    <style>
        .content > .card-header {
            background-color: #f1f1f1;
        }

        .btn-tab:hover {
            color: #ffffff;
            background-color: #20f99f;
        }

        button.active {
            background-color: #18d26e !important;
        }
    </style>
@endsection

@section('main')
    <div class="h2">{{ $service->name }}</div>
    <div class="description">{!! $service->detail !!}</div>

    @if ($service->permission->isEmpty())
        Mohon maaf, izin sedang di proses
    @else
        <div class="content card my-3">
            <div class="card-header">
                <ul class="nav nav-pills" id="tab" role="tablist">
                    @foreach ($service->permission as $permission)
                        <li class="nav-item">
                            <button class="nav-link btn btn-tab rounded-0 {{ $loop->iteration == 1 ? 'active' : '' }}"
                                id="izin-{{ $loop->iteration }}-tab" data-toggle="tab" href="#izin-{{ $loop->iteration }}"
                                role="tab">{{ Str::words($permission->name, 5) }}</button>
                        </li>
                    @endforeach
                    @if (!$service->permissionForm->isEmpty())
                        <li class="nav-item">
                            <button class="nav-link btn btn-tab rounded-0" id="berkas-tab" data-toggle="tab" href="#berkas"
                                role="tab">Berkas</button>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    @foreach ($service->permission as $permission)
                        <div class="tab-pane fade {{ $loop->iteration == 1 ? 'show active' : '' }} px-3"
                            id="izin-{{ $loop->iteration }}" role="tabpanel" aria-labelledby="Izin{{ $loop->iteration }}">
                            <div class="h6"><strong>{{ $permission->name }}</strong></div>
                            {!! $permission->requirement !!}
                        </div>
                    @endforeach
                    <div class="tab-pane fade" id="berkas" role="tabpanel" aria-labelledby="Berkas">
                        <ol>
                            @foreach ($service->permissionForm as $form)
                                <li><a href="{{ $form->form }}" download="">{{ $form->name }}</a></li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection
