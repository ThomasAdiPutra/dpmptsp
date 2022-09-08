@extends('layout.master-admin', ['title'=>'Agenda'])

@section('head')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.css' rel='stylesheet' />
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.js'></script>
    <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                eventColor: 'green',
                displayEventTime: false,
                editable: true,
                selectable: true,
                select: function(info) {
                    Swal.fire({
                        title: 'Masukkan Judul Agenda',
                        input: 'text',
                        showCancelButton: true,
                        confirmButtonText: 'Oke',
                        cancelButtonText: 'Batal',
                        inputValidator: (title) => {
                            if (!title) {
                                return 'Judul agenda wajib diisi';
                            }
                        },
                    }).then((title) => {
                        if (title['value'] && title.isConfirmed) {
                            $.ajax({
                                url: "{{ route('agenda.store') }}",
                                data: {
                                    '_token': '{{ csrf_token() }}',
                                    title: title['value'],
                                    start_date: info.startStr,
                                    end_date: info.endStr,
                                },
                                type: "POST",
                                success: function(data) {
                                    calendar.addEvent({
                                        id: data.id,
                                        title: data.title,
                                        start: data.start_date,
                                        end: data.end_date,
                                    });
                                    calendar.render();
                                    swal('Berhasi mengubah agenda');
                                }
                            });
                        }
                        calendar.unselect();
                    });
                },
                events: [
                    @foreach ($agendas as $agenda)
                        {
                            id: '{{ $agenda->id }}',
                            title: '{{ $agenda->title }}',
                            start: '{{ $agenda->start_date }}',
                            end: '{{ $agenda->end_date }}',
                        },
                    @endforeach
                ],
                eventContent: function(info) {
                    title = info.event.title
                    el = `<span data-toggle="tooltip" title="${title}">${title}</span>`
                    return {
                        html: el
                    };
                },
                eventDidMount: (info) => {
                    info.el.addEventListener("contextmenu", (jsEvent) => {
                        jsEvent.preventDefault();
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Tindakan ini tidak dapat dibatalkan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus agenda!',
                            cancelButtonText: 'Batal',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: `{{ url('/agenda') }}/${info.event.id}`,
                                    data: {
                                        '_method': 'DELETE',
                                        '_token': '{{ csrf_token() }}',
                                    },
                                    type: "POST",
                                }).then((data) => {
                                    $('[data-toggle="tooltip"]').tooltip(
                                        "hide");
                                    info.event.remove();
                                    swal('Berhasil menghapus agenda');
                                });
                            }
                        });
                    })
                },
                eventMouseEnter: function(info) {
                    $(info.el).find('[data-toggle="tooltip"]').tooltip('show');
                },
                eventMouseLeave: function(info) {
                    $(info.el).find('[data-toggle="tooltip"]').tooltip('hide');
                },
                eventClick: function(info) {
                    let id = info.event.id;
                    Swal.fire({
                        title: 'Masukkan Judul Agenda',
                        input: 'text',
                        showCancelButton: true,
                        confirmButtonText: 'Oke',
                        cancelButtonText: 'Batal',
                        inputValidator: (title) => {
                            if (!title) {
                                return 'Judul agenda wajib diisi';
                            }
                        },
                    }).then((title) => {
                        if (title['value'] && title.isConfirmed) {
                            $.ajax({
                                url: `{{ url('/agenda') }}/${id}`,
                                data: {
                                    '_token': '{{ csrf_token() }}',
                                    '_method': 'PATCH',
                                    'title': title['value'],
                                    'start_date': info.event.startStr,
                                    'end_date': info.event.endStr,
                                },
                                type: "POST",
                                success: function(data) {
                                    updatedEvent = {
                                        ...info.event,
                                        'id': info.event.id,
                                        'title': title['value'],
                                        'start': info.event.startStr,
                                        'end': info.event.endStr,
                                    };
                                    info.event.remove();
                                    calendar.addEvent(updatedEvent);
                                    calendar.render();
                                    swal('Berhasil mengubah agenda');
                                }
                            });
                        }
                    });
                },
                eventDrop: function(info) {
                    $('[data-toggle="tooltip"]').tooltip("hide");
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Tindakan ini tidak dapat dibatalkan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `{{ url('/agenda') }}/${info.event.id}`,
                                data: {
                                    '_method': 'PATCH',
                                    '_token': '{{ csrf_token() }}',
                                    'title': info.event.title,
                                    'start_date': info.event.startStr,
                                    'end_date': info.event.endStr,
                                },
                                type: "POST",
                            }).then((data) => {
                                $('[data-toggle="tooltip"]').tooltip("hide");
                                updatedEvent = {
                                    ...info.event,
                                    id: data.id,
                                    title: data.title,
                                    start: data.start_date,
                                    end: data.end_date
                                };
                                info.event.remove()
                                calendar.addEvent(updatedEvent);
                                swal('Berhasil mengubah agenda');
                            }).catch((error) => {
                                swal(error.message, 'error');
                                info.revert();
                            });
                        } else {
                            info.revert();
                        }
                    });
                    $('[data-toggle="tooltip"]').tooltip("hide");
                },
                eventDragStop: function(info) {
                    $('[data-toggle="tooltip"]').tooltip("hide");
                }
            });
            calendar.render();
        });

        function swal(message, icon='success') {
            Swal.fire({
                position: 'top-end',
                icon: icon,
                title: `${message}`,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
@endsection
